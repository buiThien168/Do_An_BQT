<?php

namespace App\Http\Controllers\Staff\Infomation;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\InfoUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class InfomationController extends Controller
{   
    protected $InfoUserService;
    public function __construct(InfoUserService $InfoUserService)
    {
        $this->InfoUserService = $InfoUserService;
    }
    public function Infomation(){
        $getInfo = $this->InfoUserService->Infomation();
        return view('Staff.Infomation.Index',['getInfo'=>$getInfo]);
    }
    public function PostEditInfomation(Request $request){
        $validate = $request->validate([
            'email'=>'required|email',
        ]);
        $this->InfoUserService->PostEditInfomation($request);
        return redirect()->back()->with('msg', 'Thay đổi thông tin thành công'); 
    }

    
    
}
