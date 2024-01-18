<?php

namespace App\Http\Controllers\Staff\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SalaryController extends Controller
{   



    public function ListSalary(Request $request){
        $GetTime = DB::table('user_track')->where('user_id',Auth::user()->id)->get();

        $GetSalary = DB::table('salary')->where('user_id',Auth::user()->id)->first('hourly_salary');

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
      
        if($GetSalary == null){
            $salary = 0;
        }else{
            $salary = $countTime/60/60*$GetSalary->hourly_salary;
        }
        $time=gmdate("H:i:s",$countTime);
        
        $mounth = date('n');
        return view('Staff.Salary.ListSalary',
            [
                'checktime'=>$checktime,
                'time'=>$time,
                'salary'=>$salary,
                'mounth'=>$mounth,
                'GetSalary'=>$GetSalary->hourly_salary
            ]
        );
    }   
}
