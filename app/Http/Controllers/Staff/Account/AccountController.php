<?php

namespace App\Http\Controllers\Staff\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


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
            if(Auth::user()->role == 1){
                return Redirect::to('admin/user-management');
            }else if(Auth::user()->role == 2){
                return Redirect::to('account-information');
            }
            
        }else{
            return view('Staff.Login.Login');
        } 
    }
    public function PostLogin(Request $request){

        $user = User::where('phone', '=', $request->phone)->where('password', '=', md5($request->password))->first();

        if($user){
            if($user->role==2){
                if($user->active ==1 && $user->is_deleted ==0){
                    Auth::login($user,true);
                    return Redirect::to('/account-information');
                }else{
                   return redirect()->back()->with('msg', 'Your account is temporarily locked'); 
                }
                
            }else{
                return redirect()->back()->with('msg', 'Wrong account or password');
            }
        }else{
            return redirect()->back()->with('msg', 'Wrong account or password'); 
        }  

 }


}
