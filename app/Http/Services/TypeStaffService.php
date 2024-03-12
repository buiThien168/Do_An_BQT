<?php

namespace App\Http\Services;

use App\Models\Employee_type;
use App\Models\User;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class TypeStaffService
{
    public function ListTypeStaff($request)
    {
        $GetTypeStaffs = Employee_type::where('deleted', 0)->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetTypeStaffs = $GetTypeStaffs
                ->where('name','like', "%$request->keyword%");
        }
        $GetTypeStaffs = $GetTypeStaffs->paginate(15);
        return $GetTypeStaffs;
    }
    public function TypeStaffIFUsers()
    {
        $getUsers = User_infomation::where('employee_type', '!=', null)->get('employee_type');
        return $getUsers;
    }
    public function PostAddTypeStaff($request)
    {
        $PostAddTypeStaff = Employee_type::insert([
            'name' => $request->name,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updated_at' => null,
            'updater' => null,
            'deleted' => 0,
        ]);
        return $PostAddTypeStaff;
    }
    public function EditTypeStaff($id){
        $getTypeStaff = Employee_type::where('id',$id)->first();
        return $getTypeStaff;
    }
    public function PostEditTypeStaff($id,$request){
        $PostEditTypeStaff = Employee_type::where('id',$id)->update([
            'name' => $request->name,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updated_at' => null,
            'updater' => null,
            'deleted' => 0,
        ]);
        return  $PostEditTypeStaff;
    }
    public function DeleteTypeStaff($id){
        $DeleteTypeStaff = Employee_type::where('id',$id)->delete();
        return $DeleteTypeStaff;
    }
    public function ListStaff($id,$request){
        $GetListStaffs = User_infomation::where('employee_type',$id)
        ->where('full_name','!=',null)
        ->orderBy('id', 'DESC');
        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->Where('nick_name','like','%'.$request->keyword.'%')
            ->where('employee_type',$id);
        };
        $GetListStaffs=$GetListStaffs->paginate(15);
        return $GetListStaffs;
    }
}
