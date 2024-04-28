<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class contractController extends Controller
{
    public function ListContract(){
        return view('Admin.Contract.AddContract');
    }
}
