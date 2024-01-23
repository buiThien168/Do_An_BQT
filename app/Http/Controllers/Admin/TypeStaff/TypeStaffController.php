<?php

namespace App\Http\Controllers\Admin\TypeStaff;

use App\Http\Controllers\Controller;
use App\Http\Services\TypeStaffService;
use App\Models\Employee_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TypeStaffController extends Controller
{   

    protected $TypeStaffService;
    public function __construct(TypeStaffService $TypeStaffService)
    {
        $this->TypeStaffService = $TypeStaffService;
    }
    public function ListStaff($id,Request $request){
        $GetListStaffs= $this->TypeStaffService->ListStaff($id,$request);
        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }


    public function DeleteTypeStaff($id){
        $this->TypeStaffService->DeleteTypeStaff($id);
        return redirect('admin/manage-employee-type');
    }

    public function ListTypeStaff(Request $request){
        $GetTypeStaffs = $this->TypeStaffService->ListTypeStaff($request);
        $getUsers = $this->TypeStaffService->TypeStaffIFUsers();
        return view('Admin.TypeStaff.ListTypeStaff',
            [
                'GetTypeStaffs'=>$GetTypeStaffs,
                'getUsers'=>$getUsers
            ]
        );
    }
    public function AddTypeStaff(){
        return view('Admin.TypeStaff.AddTypeStaff');
    }

    public function PostAddTypeStaff(Request $request){
        $validate = $request->validate([
            'name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->TypeStaffService->PostAddTypeStaff($request);
        return redirect('admin/manage-employee-type');
    }

    public function EditTypeStaff($id){
        $getTypeStaff = $this->TypeStaffService->EditTypeStaff($id);
        return view('Admin.TypeStaff.EditTypeStaff',['getTypeStaff'=>$getTypeStaff,'id'=>$id]);
    }
    public function PostEditTypeStaff($id,Request $request){
        $validate = $request->validate([
            'name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->TypeStaffService->PostEditTypeStaff($id,$request);
        return redirect('admin/manage-employee-type');
    }

    
}
