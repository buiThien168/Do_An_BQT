<?php

namespace App\Http\Controllers\Admin\Infomation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class InfomationController extends Controller
{   
    
    public function Infomation(){
        $getInfo = DB::table('users')
        ->leftJoin('user_infomations','user_infomations.user_id','users.id')
        ->where('role',1)->first();
        return view('Admin.Infomation.Index',['getInfo'=>$getInfo]);
    }
    public function PostEditInfomation(Request $request){
        $validate = $request->validate([
            'phone'=>'required|digits:10',
            'email'=>'required|email',
        ]);
       


        DB::table('users')->where('id',Auth::user()->id)->update(
            [   
                'phone'=>$request->phone,
            ]
        ); 
        DB::table('user_infomations')->where('user_id',Auth::user()->id)->update(
            [   
                'email'=>$request->email,

            ]
        ); 
        
        
        return redirect()->back()->with('msg', 'Successful change of information'); 
    }

    
    
}
