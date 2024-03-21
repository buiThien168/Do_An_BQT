<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PayrollController extends Controller
{   



    public function ListPayroll(Request $request){
        $GetPayrolls = DB::table('users')
        ->leftJoin('salary','salary.user_id','users.id')
        ->leftJoin('user_infomations','user_infomations.id','users.id')
        ->leftJoin('positions','positions.id','user_infomations.positions')
        ->leftJoin('level','level.id','user_infomations.level')
        ->select('user_infomations.full_name','users.id','positions.name_position','salary.basic_salary','salary.created','level.qualification_name')
        ->orderBy('users.id', 'DESC')
        ->where('user_infomations.full_name','!=',null)
        ;

        if(isset($request->keyword)){
            $GetPayrolls=$GetPayrolls
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->orWhere('user_infomations.id_number',$request->keyword);
        }
        $GetPayrolls=$GetPayrolls->paginate(15);

        

        return view('Admin.Payroll.ListPayroll',
            [
                'GetPayrolls'=>$GetPayrolls,

            ]
        );
    }
    

    

    public function EditPayroll($id){
        $getPayroll = DB::table('salary')->where('user_id',$id)->first();
        return view('Admin.Payroll.EditPayroll',['getPayroll'=>$getPayroll,'id'=>$id]);
    }
    public function PostEditPayroll($id,Request $request){
        $validate = $request->validate([
            'basic_salary' => 'required|integer',
        ]);
        $getPayroll = DB::table('salary')->where('user_id',$id)->first();

        if($getPayroll == null){
            DB::table('salary')->insert(
                [   
                    'user_id'=>$id,
                    'basic_salary'=>$request->basic_salary,
                    'created'=>time(),
                    'created_by'=>Auth::user()->id,
                ]
            ); 
        }else{
            DB::table('salary')->where('user_id',$id)->update(
                [   
                    'basic_salary'=>$request->basic_salary,
                    'updated_at'=>time(),
                    'updater'=>Auth::user()->id,
                ]
            ); 
        }
        
        return redirect('admin/salary-management');
    }

    
}
