<?php

namespace App\Http\Controllers\Admin\Specialize;

use App\Http\Controllers\Controller;
use App\Http\Services\SpecializeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SpecializeController extends Controller
{   
    protected $SpecializeService;
    public function __construct(SpecializeService $SpecializeService)
    {
        $this->SpecializeService = $SpecializeService;
    }
    public function ListStaff($id,Request $request){
       
        $GetListStaffs= $this->SpecializeService->ListStaff($id,$request);
        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }

    public function DeleteSpecialize($id){
       $this->SpecializeService->DeleteSpecialize($id);
        return redirect('admin/professional-management');
    }

    public function ListSpecialize(Request $request){
        $GetSpecializes = $this->SpecializeService->ListSpecialize($request);
        $getUsers =  $this->SpecializeService->getSpecializeUser();
        return view('Admin.Specialize.ListSpecialize',
            [
                'GetSpecializes'=>$GetSpecializes,
                'getUsers'=>$getUsers
            ]
        );
    }
    public function AddSpecialize(){
        return view('Admin.Specialize.AddSpecialize');
    }

    public function PostAddSpecialize(Request $request){
        $validate = $request->validate([
            'name_specializes' => 'required|max:255',
            'note'=>'max:255'
        ]); 
        $this->SpecializeService->PostAddSpecialize($request);
        return redirect('admin/professional-management');
    }

    public function EditSpecialize($id){
        $getSpecialize = $this->SpecializeService->getEditSpecialize($id);
        return view('Admin.Specialize.EditSpecialize',['getSpecialize'=>$getSpecialize,'id'=>$id]);
    }
    public function PostEditSpecialize($id,Request $request){
        $validate = $request->validate([
            'name_specializes' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->SpecializeService->PostEditSpecialize($id,$request);
        return redirect('admin/professional-management');
    }
}
