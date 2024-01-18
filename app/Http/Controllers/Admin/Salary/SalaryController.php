<?php

namespace App\Http\Controllers\Admin\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SalaryController extends Controller
{   

    public function ListSalaryStaffDetail($id){
        
        
        $GetTime = DB::table('user_track')->where('user_id',$id)->get();

        $GetSalary = DB::table('salary')->where('user_id',$id)->first('hourly_salary');
        

        $countTime = 0;

        $checktime = array();
        for ($i=1; $i < count($GetTime); $i++) { 
            if($GetTime[$i]->type == 1){
                $countTime += $GetTime[$i]->created_at - $GetTime[$i-1]->created_at;
                array_push($checktime, [
                    'checkin' => $GetTime[$i-1]->created_at,
                    'checkout' => $GetTime[$i]->created_at,
                    'time'=>gmdate("H:i:s",$GetTime[$i]->created_at - $GetTime[$i-1]->created_at),  
                    'salary'=>($GetTime[$i]->created_at - $GetTime[$i-1]->created_at)/60/60*$GetSalary->hourly_salary
                ]);
            }
        }
      
        
        $time=gmdate("H:i:s",$countTime);
        $salary = $countTime/60/60*$GetSalary->hourly_salary;
        
        $mounth = date('n');
        return view('Admin.Salary.ListSalaryStaffDetail',
            [
                'checktime'=>$checktime,
                'time'=>$time,
                'salary'=>$salary,
                'mounth'=>$mounth,
                'GetSalary'=>$GetSalary->hourly_salary
            ]
        );
    
    }

    public function ListSalaryStaff(){
        $getStaff = DB::table('users')
        ->leftJoin('user_infomations','user_infomations.user_id','users.id')
        ->leftJoin('salary','salary.user_id','users.id')
        ->leftJoin('positions','positions.id','user_infomations.positions')
        ->select('users.id','user_infomations.full_name','salary.hourly_salary','positions.name_position')
        ->where('users.role',2)
        ->orderBy('users.id','desc')
        ->paginate(15);
        $checktime=array();
        for ($i=0; $i < $getStaff->total() ; $i++) { 
            $GetTime = DB::table('user_track')->where('user_id',$getStaff[$i]->id)->get();
            $GetSalary = DB::table('salary')->where('user_id',$getStaff[$i]->id)->first('hourly_salary');
            $total =0;
            for ($j=1; $j < count($GetTime); $j++) { 
                if($GetTime[$j]->type == 1){
                    $total+=($GetTime[$j]->created_at - $GetTime[$j-1]->created_at)/60/60*$GetSalary->hourly_salary;
                }
            }
            array_push($checktime, [
                'id'=>$getStaff[$i]->id,  
                'salary'=>$total 
            ]);
        }
        return view('Admin.Salary.ListSalaryStaff',['getStaff'=>$getStaff,'checktime'=>$checktime]);
        
    }



    public function ListSalary(Request $request){
        $GetSalarys = DB::table('users')
        ->leftJoin('salary','salary.user_id','users.id')
        ->leftJoin('user_infomations','user_infomations.id','users.id')
        ->leftJoin('positions','positions.id','user_infomations.positions')
        ->leftJoin('level','level.id','user_infomations.level')
        ->select('user_infomations.full_name','users.id','positions.name_position','salary.hourly_salary','salary.created','level.qualification_name')
        ->orderBy('users.id', 'DESC')
        ->where('user_infomations.full_name','!=',null)
        ;

        if(isset($request->keyword)){
            $GetSalarys=$GetSalarys
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->orWhere('user_infomations.id_number',$request->keyword);
        }
        $GetSalarys=$GetSalarys->paginate(15);

        

        return view('Admin.Salary.ListSalary',
            [
                'GetSalarys'=>$GetSalarys,

            ]
        );
    }
    

    

    public function EditSalary($id){
        $getSalary = DB::table('salary')->where('user_id',$id)->first();
        return view('Admin.Salary.EditSalary',['getSalary'=>$getSalary,'id'=>$id]);
    }
    public function PostEditSalary($id,Request $request){
        $validate = $request->validate([
            'hourly_salary' => 'required|integer',
        ]);
        $getSalary = DB::table('salary')->where('user_id',$id)->first();

        if($getSalary == null){
            DB::table('salary')->insert(
                [   
                    'user_id'=>$id,
                    'hourly_salary'=>$request->hourly_salary,
                    'created'=>time(),
                    'created_by'=>Auth::user()->id,
                ]
            ); 
        }else{
            DB::table('salary')->where('user_id',$id)->update(
                [   
                    'hourly_salary'=>$request->hourly_salary,
                    'updated_at'=>time(),
                    'updater'=>Auth::user()->id,
                ]
            ); 
        }
        
        return redirect('admin/salary-management');
    }

    
}
