<?php

namespace App\Http\Controllers\Admin\ChangePassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use DB;

class ChangePasswordController extends Controller
{   
    public function ChangePassword(){
        return view('Admin.ChangePassword.Index');
    }

    public function PostChangePassword(Request $request){
        $passwordNow =  md5($request['passwordNow']);
        $passwordNew =  $request['passwordNew'];
        $passwordNewRe =  $request['passwordNewRe'];
        $CheckPassword = User::where('id',Auth::user()->id)->first();
        if($passwordNew == $passwordNewRe && $passwordNow == $CheckPassword->password){
            DB::table('users')->where('id',Auth::user()->id)->update(['password'=>md5($passwordNew)]);
           
            return redirect()->back()->with('msg', 'Change Password Successfully'); 
        }else{
            return redirect()->back()->with('msg', 'Old password is not correct');
        }
        
    }
}
