<?php

namespace App\Http\Services;

use App\Models\educational;
use App\Models\Level;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class EducationalServices
{
   
    public function ListEducational($request)
    {
        $GetEducation = educational::where('deleted', 0)->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetEducation = $GetEducation
                ->where('name_education','like', "%$request->keyword%");
        }
        $GetEducation = $GetEducation->paginate(15);
        return $GetEducation;
    }
    public function getUsersListEducation()
    {
        $getUsers = User_infomation::where('educational', '!=', null)->get('educational');
        return $getUsers;
    }
    public function PostAddEducation($request)
    {
        $PostAddEducation = educational::create([
            'name_education' => $request->name_education,
            'note' => $request->note,
            'created_by' => Auth::user()->id,
            'deleted' => 0,
        ]);
        return $PostAddEducation;
    }
    public function GetgetEducationID($id)
    {
        $getEducation = educational::where('id', $id)->first();
        return $getEducation;
    }
    public function PostEditEducation($id, $request)
    {
        $PostEditEducation = educational::where('id', $id)->update([
            'name_education' => $request->name_education,
            'note' => $request->note,
            'created_by' => Auth::user()->id,
            'deleted' => 0,
        ]);
        return $PostEditEducation;
    }
    public function DeleteEducation($id){
        $DeleteEducation = educational::where('id',$id)->delete();
        return $DeleteEducation;
    }
    public function ListEducationStaff($id,$request){
        $GetListStaffs = User_infomation::where('educational',$id)
        ->where('full_name','!=',null)
        ->orderBy('id', 'DESC');
        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->Where('nick_name','like','%'.$request->keyword.'%')
            ->where('educational',$id);
        };
        $GetListStaffs=$GetListStaffs->paginate(15);
        return $GetListStaffs;
    }
}
