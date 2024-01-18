<?php

namespace App\Http\Controllers\Admin\TypeStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TypeStaffController extends Controller
{   

    public function ListStaff($id,Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('employee_type',$id)
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


    public function DeleteTypeStaff($id){
        DB::table('employee_type')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/manage-employee-type');
    }

    public function ListTypeStaff(Request $request){
        $GetTypeStaffs = DB::table('employee_type')
        ->where('deleted',0)
        ->orderBy('id', 'DESC');

        if(isset($request->keyword)){
            $GetTypeStaffs=$GetTypeStaffs
            ->where('name',$request->keyword);
        }
        $GetTypeStaffs=$GetTypeStaffs->paginate(15);

        $getUsers = DB::table('user_infomations')->where('employee_type','!=',null)->get('employee_type');
        

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
        DB::table('employee_type')->insert(
            [   
                'name'=>$request->name,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/manage-employee-type');
    }

    public function EditTypeStaff($id){
        $getTypeStaff = DB::table('employee_type')->where('id',$id)->first();
        return view('Admin.TypeStaff.EditTypeStaff',['getTypeStaff'=>$getTypeStaff,'id'=>$id]);
    }
    public function PostEditTypeStaff($id,Request $request){
        $validate = $request->validate([
            'name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        DB::table('employee_type')->where('id',$id)->update(
            [   
                'name'=>$request->name,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/manage-employee-type');
    }

    
}
