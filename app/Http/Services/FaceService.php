<?php

namespace App\Http\Services;

use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_face;
use App\Models\User_infomation;
use App\Models\Work;
use App\Models\Work_progress;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class FaceService
{
    public function ResetFaceStaff($id){
        $ResetFaceStaff = User_face::where('user_id',$id)->delete();
        return $ResetFaceStaff;
    }
    public function FaceStaffDetail($id){
        $getImages= User_face::where('user_id',$id)->get();
        return $getImages;
    }
    public function ListFaceStaff($request){
        $GetListStaffs = User_infomation::where('full_name','!=',null)
        ->orderBy('id', 'DESC');
        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->where('user_id',$request->keyword)
            ->orWhere('id_number',$request->keyword)
            ->orWhere('full_name',$request->keyword);
        }
        $GetListStaffs=$GetListStaffs->paginate(15);
        return $GetListStaffs;
    }
}