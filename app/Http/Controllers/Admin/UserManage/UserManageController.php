<?php

namespace App\Http\Controllers\Admin\UserManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class UserManageController extends Controller
{   
    public function ListUser(){
        $GetUsers = DB::table('users')
        ->leftJoin('user_infomations','user_infomations.user_id','users.id')
        ->select('user_infomations.full_name','users.*','user_infomations.image','user_infomations.email')
        ->where('users.is_deleted',0)
        ->orderBy('users.id', 'DESC') 
        ->where('users.role','=',2)
        ->paginate(10);

        
        return view('Admin.UserManage.ListUser',['GetUsers'=>$GetUsers ]);
    }
    public function BlockUnBlockUser($id){
        if(isset($id)){
            $FindUserById = User::find($id);
            if($FindUserById != null){
                if($FindUserById->active == 0){
                    $FindUserById->active=1;
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
            $GetUsers = DB::table('users')
            ->where('users.role', '=',3)
            ->Where('users.phone', '=',$request->keyword)
            ->orderBy('users.id', 'DESC') 
            ->paginate(10);
            return view('Admin.UserManage.ListUser',
                [
                    'GetUsers'=>$GetUsers,
                ]
            );
        }
    }
    
}
