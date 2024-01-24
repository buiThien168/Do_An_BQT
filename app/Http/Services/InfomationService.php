<?php

namespace App\Http\Services;

use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_infomation;
use App\Models\Work;
use App\Models\Work_progress;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class InfomationService
{
    public function Infomation()
    {
        $getInfo = User::leftJoin('user_infomations', 'user_infomations.user_id', 'users.id')
            ->where('role', 1)->first();
        return  $getInfo;
    }
    public function PostEditInfomation($request)
    {
        User::where('id', Auth::user()->id)->update([
            'phone' => $request->phone,
        ]);
        User_infomation::where('user_id', Auth::user()->id)->update([
            'email' => $request->email,
        ]);
    }
    public function PostChangePassword($passwordNew){
        $PostChangePassword = User::where('id', Auth::user()->id)->update(['password'=>md5($passwordNew)]);
        return $PostChangePassword;
    }
}
