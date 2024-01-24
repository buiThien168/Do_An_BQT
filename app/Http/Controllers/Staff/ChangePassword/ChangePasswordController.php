<?php

namespace App\Http\Controllers\Staff\ChangePassword;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\InfoUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{   
    protected $InfoUserService;
    public function __construct(InfoUserService $InfoUserService)
    {
        $this->InfoUserService = $InfoUserService;
    }
    public function ChangePassword(){
        return view('Staff.ChangePassword.Index');
    }

    public function PostChangePassword(Request $request){
        $passwordNow =  md5($request['passwordNow']);
        $passwordNew =  $request['passwordNew'];
        $passwordNewRe =  $request['passwordNewRe'];
        $CheckPassword = $this->InfoUserService->CheckPassword();
        if($passwordNew == $passwordNewRe && $passwordNow == $CheckPassword->password){
           $this->InfoUserService->PostChangePassword($passwordNew);
            return redirect()->back()->with('msg', 'Change Password Successfully'); 
        }else{
            return redirect()->back()->with('msg', 'Old password is not correct');
        }
        
    }
}
