<?php

namespace App\Http\Services\Staff;

use App\Models\Salary;
use App\Models\User_face;
use App\Models\User_infomation;
use App\Models\User_track;
use App\Models\Work;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class StaffFaceService
{
    public function FaceStaffDetail(){
        $getImages= User_face::where('user_id',Auth::user()->id)->get();
        return  $getImages;
    }
    public function RegisterFace(){
        $checkHaveFace = User_face::where('user_id',Auth::user()->id)
        ->orderBy('id','desc')
        ->first();
        return $checkHaveFace;
    }
    public function getFullNameRegisterFace(){
        $getFullName =  User_infomation::where('user_id',Auth::user()->id)->first('full_name');
        return $getFullName;
    }
    public function PostRegisterFace($imageName,$getFullName,$getMax){
        $PostRegisterFace = User_face::create([
            'image' => $imageName,
            'name' => $getFullName->full_name,
            'order_by' => $getMax,
            'user_id' => Auth::user()->id
        ]);
        return $PostRegisterFace;
        // $PostRegisterFace = User_face::insert([
        //     'image'=>$imageName,
        //     'name'=>$getFullName->full_name,
        //     'order_by'=>$getMax,
        //     'user_id'=>Auth::user()->id
        // ]);
        // return $PostRegisterFace;
    }
}