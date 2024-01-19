<?php

namespace App\Http\Controllers\Admin\UserManage;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class UserManageController extends Controller
{   
    protected $UserService;
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }
    public function ListUser(){
        $GetUsers=$this->UserService->ListUserServices();
        return view('Admin.UserManage.ListUser',['GetUsers'=>$GetUsers ]);
    }
    public function BlockUnBlockUser($id){
        dd($id);
        if(isset($id)){
            $FindUserById = User::find($id);
            if($FindUserById != null){
                if($FindUserById->active == 0){
                    $FindUserById->active=1;
                    $FindUserById->updated_at=now();
                    $FindUserById->save();
                    return back();
                }else if($FindUserById->active == 1){
                    $FindUserById->active=0;
                    $FindUserById->save();
                    return back();
                }else{
                    return Redirect::to('/404');
                }               
            }else{
                return Redirect::to('/404');
            }
        }else{
            return Redirect::to('/404');
        }
    }

    public function SearchUser(Request $request){
        if(isset($request->keyword)){
            $GetUsers = $this->UserService->SearchUserServices($request);
            return view('Admin.UserManage.ListUser',
                [
                    'GetUsers'=>$GetUsers,
                ]
            );
        }
    }
    
}
