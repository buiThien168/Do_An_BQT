<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use App\Http\Services\DepartmentsService;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\User_infomation;

class DepartmentController extends Controller
{   
    protected $DepartmentsService;
    public function __construct(DepartmentsService $DepartmentsService)
    {
        $this->DepartmentsService = $DepartmentsService;
    }
    public function ListStaff($id,Request $request){
        $GetListStaffs = $this->DepartmentsService->ListStaffDepartment($id,$request);
        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }
    public function DeleteDepartment($id){
        $this->DepartmentsService->DeleteDepartment($id);
        return redirect('admin/department-manager');
    }

    public function ListDepartment(Request $request){
        $GetDepartments = $this->DepartmentsService->GetListDepartment($request);
        $getUsers = $this->DepartmentsService->GetUsersRoom();
        return view('Admin.Department.ListDepartment',
            [
                'GetDepartments'=>$GetDepartments,
                'getUsers'=>$getUsers
            ]
        );
    }
    public function AddDepartment(){
        return view('Admin.Department.AddDepartment');
    }

    public function PostAddDepartment(Request $request){
        $validate = $request->validate([
            'room_name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->DepartmentsService->AddDepartment($request);
        return redirect('admin/department-manager');
    }

    public function EditDepartment($id){
        $getDepartment = $this->DepartmentsService->GetIFoRoom($id);
        return view('Admin.Department.EditDepartment',['getDepartment'=>$getDepartment,'id'=>$id]);
    }
    public function PostEditDepartment($id,Request $request){
        $validate = $request->validate([
            'room_name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->DepartmentsService->PostEditDepartment($id,$request);
        return redirect('admin/department-manager');
    }

    
}
