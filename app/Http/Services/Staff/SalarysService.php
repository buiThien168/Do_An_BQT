<?php

namespace App\Http\Services\Staff;

use App\Models\Salary;
use App\Models\User_track;
use App\Models\Work;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class SalarysService
{
    public function GetTime(){
        $GetTime = User_track::where('user_id',Auth::user()->id)->get();
        return  $GetTime;
    }
    public function GetSalary(){
        $GetSalary = Salary::where('user_id',Auth::user()->id)->first('basic_salary');
        return $GetSalary;
    }
}