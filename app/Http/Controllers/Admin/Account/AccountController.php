<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use DB;


class AccountController extends Controller
{   
    public function Logout(){
        if(Auth::user()){
            Auth::logout();
            return Redirect::to('/');
        }
    }
    public function Login(){
        if(Auth::user()){
            return Redirect::to('/');
        }else{
            return view('Admin.Login.Index');
        } 
    }
    public function LoginPost(Request $request){


        $name =  $request->name;
        $password =  md5($request->password);
        $user = User::where('name', '=', $name)->where('password', '=', $password)->first();
        

        if($user){
            if($user->role==1){
                Auth::login($user,true);
                return Redirect::to('/admin/user-management');
            }else{
                return redirect()->back()->with('msg', 'Wrong account or password');
            }
        }else{
             return redirect()->back()->with('msg', 'Wrong account or password'); 
        }  

    }

    
}
