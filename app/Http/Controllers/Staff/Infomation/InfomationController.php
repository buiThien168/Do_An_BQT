<?php

namespace App\Http\Controllers\Staff\Infomation;

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
        ->where('user_id',Auth::user()->id)->first();
        return view('Staff.Infomation.Index',['getInfo'=>$getInfo]);
    }
    public function PostEditInfomation(Request $request){
        $validate = $request->validate([
            // 'phone'=>'required|digits:10',
            'email'=>'required|email',
        ]);
       


       
        DB::table('user_infomations')->where('user_id',Auth::user()->id)->update(
            [   
                'email'=>$request->email,

            ]
        ); 
        
        
        return redirect()->back()->with('msg', 'Successful change of information'); 
    }

    
    
}
