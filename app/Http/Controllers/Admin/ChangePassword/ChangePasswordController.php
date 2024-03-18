<?php

namespace App\Http\Controllers\Admin\ChangePassword;

use App\Http\Controllers\Controller;
use App\Http\Services\InfomationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use DB;

class ChangePasswordController extends Controller
{   
    protected $InfomationService;
    public function __construct(InfomationService $InfomationService)
    {
        $this->InfomationService = $InfomationService;
    }
    public function ChangePassword(){
        return view('Admin.ChangePassword.Index');
    }

    public function PostChangePassword(Request $request){
        $passwordNow =  md5($request['passwordNow']);
        $passwordNew =  $request['passwordNew'];
        $passwordNewRe =  $request['passwordNewRe'];
        $CheckPassword = User::where('id',Auth::user()->id)->first();
        if($passwordNew == $passwordNewRe && $passwordNow == $CheckPassword->password){
            $this->InfomationService->PostChangePassword($passwordNew);
            return redirect()->back()->with('msg', 'Đổi mật khẩu thành công'); 
        }else{
            return redirect()->back()->with('msg', 'Mật khẩu cũ không đúng');
        }
        
    }
}
