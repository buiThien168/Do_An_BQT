<?php

namespace App\Http\Controllers\Admin\Educational;
use App\Http\Services\EducationalServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationalController extends Controller
{
    protected $EducationalServices;
    public function __construct(EducationalServices $EducationalServices)
    {
        $this->EducationalServices = $EducationalServices;
    }
    public function ListEducation(Request $request){
        $GetListEducation = $this->EducationalServices->ListEducational($request);
        $getUsers = $this->EducationalServices->getUsersListEducation($request);
        return view('Admin.Educationnal.ListEducation',
            [
                'GetListEducation'=>$GetListEducation,
                'getUsers'=>$getUsers

            ]
        );
    }
    public function AddEducation(){
        return view('Admin.Educationnal.AddEducation');
    }

    public function PostAddEducation(Request $request){
        $validate = $request->validate([
            'name_education' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->EducationalServices->PostAddEducation($request);
        return redirect('admin/educational-management');
    }

    public function EditEducation($id){
        $getEducation = $this->EducationalServices->GetgetEducationID($id);
        return view('Admin.Educationnal.EditEducation',['getEducation'=>$getEducation,'id'=>$id]);
    }
    public function PostEditEducation($id,Request $request){
        $validate = $request->validate([
            'name_education' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->EducationalServices->PostEditEducation($id,$request);
        return redirect('admin/educational-management');
    }
    public function DeleteEducation($id){
        $this->EducationalServices->DeleteEducation($id);
        return redirect('admin/educational-management');
    }
    public function ListEducationStaff($id,Request $request){
        $GetListStaffs = $this->EducationalServices->ListEducationStaff($id,$request);
         return view('Admin.StaffManage.ListStaffDetail',
             [
                 'GetListStaffs'=>$GetListStaffs
             ]
         );
     }
}
