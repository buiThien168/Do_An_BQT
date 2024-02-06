<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoashboardControler extends Controller
{
    public function dashboard(){
        return view('Admin.DashBoard.index');
    }
}
