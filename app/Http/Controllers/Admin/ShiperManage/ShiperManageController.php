<?php

namespace App\Http\Controllers\Admin\ShiperManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ShiperManageController extends Controller
{   
    public function ListShiper($keyword,Request $request){

        $GetShipers = DB::table('users')
        ->orderBy('users.id', 'DESC') 
        ->where('users.role','=',4);

        if(isset($request->keyword)){
            $GetShipers=$GetShipers
            ->where('id',$keyword)
            ->orWhere('cmnd',$keyword)
            ->orWhere('full_name',$keyword);
        };

        $GetShipers=$GetShipers->paginate(10);
        return view('Admin.ShiperManage.ListShiper',
            [
                'GetShipers'=>$GetShipers,
            ]
        );
    }

    public function BlockUnBlockAccountShiper($id){
        if(isset($id)){

            $FindShiperById = User::find($id);
            if($FindShiperById != null){
                if($FindShiperById->active == 0){
                    $FindShiperById->active=1;
                    $FindShiperById->save();
                    return back();
                }else if($FindShiperById->active == 1){
                    $FindShiperById->active=0;
                    $FindShiperById->save();
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

    public function SearchShiper(Request $request){
    
        if(isset($request->keyword)){
            $GetShipers = DB::table('users')
            ->where('users.role', '=',4)
            ->Where('users.phone', '=', $request->keyword)
            ->orderBy('users.id', 'DESC') 
            ->paginate(10);
            return view('Admin.ShiperManage.ListShiper',
                [
                    'GetShipers'=>$GetShipers,
                ]
            );
        }
    }
    
}
