<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DepartmentController extends Controller
{   
    public function ListStaff($id,Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('rooms',$id)
        ->where('full_name','!=',null)
        ->orderBy('id', 'DESC');

        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->where('user_id',$request->keyword)
            ->orWhere('id_number',$request->keyword)
            ->where('rooms',$id)
            ->where('full_name','!=',null)
            ->orWhere('full_name',$request->keyword)
            ->where('rooms',$id)
            ->where('full_name','!=',null);
        };
        $GetListStaffs=$GetListStaffs->paginate(15);

        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }
    public function DeleteDepartment($id){
        DB::table('rooms')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/department-manager');
    }

    public function ListDepartment(Request $request){
        $GetDepartments = DB::table('rooms')
        ->where('deleted',0)
        ->orderBy('id', 'DESC');

        if(isset($request->keyword)){
            $GetDepartments=$GetDepartments
            ->where('room_name',$request->keyword);
        }
        $GetDepartments=$GetDepartments->paginate(15);

        $getUsers = DB::table('user_infomations')->where('rooms','!=',null)->get('rooms');

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
        DB::table('rooms')->insert(
            [   
                'room_name'=>$request->room_name,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/department-manager');
    }

    public function EditDepartment($id){
        $getDepartment = DB::table('rooms')->where('id',$id)->first();
        return view('Admin.Department.EditDepartment',['getDepartment'=>$getDepartment,'id'=>$id]);
    }
    public function PostEditDepartment($id,Request $request){
        $validate = $request->validate([
            'room_name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        DB::table('rooms')->where('id',$id)->update(
            [   
                'room_name'=>$request->room_name,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/department-manager');
    }

    
}
