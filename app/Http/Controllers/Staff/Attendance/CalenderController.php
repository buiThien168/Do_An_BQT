<?php

namespace App\Http\Controllers\Staff\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function Calender(){
        return view('Staff.Attendance.Calender');
    }
}
