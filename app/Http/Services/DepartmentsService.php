<?php

namespace App\Http\Services;

use App\Models\Room;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class DepartmentsService
{

    public function GetUsersRoom()
    {
        $getUsers = User_infomation::where('rooms', '!=', null)->get('rooms');
        return $getUsers;
    }
    public function GetIFoRoom($id)
    {
        $getUsers = Room::where('id', $id)->first();
        return $getUsers;
    }
    public function PostEditDepartment($id, $request)
    {
        $EditDepartment = Room::where('id', $id)->update([
            'room_name' => $request->room_name,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updated_at' => null,
            'updater' => null,
            'deleted' => 0,
        ]);
        return $EditDepartment;
    }
    public function GetListDepartment($request)
    {
        $GetDepartments = Room::where('deleted', 0)->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetDepartments = $GetDepartments
                ->where('room_name', $request->keyword);
        }
        $GetDepartments = $GetDepartments->paginate(15);
        return $GetDepartments;
    }
    public function AddDepartment($request)
    {
        $AddDepartment = Room::insert([
            'room_name' => $request->room_name,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
        ]);
        return $AddDepartment;
    }
    public function DeleteDepartment($id){
        $Departmen= Room::Where('id',$id)->delete();
        return $Departmen;
    }
    public function ListStaffDepartment($id, $request)
    {
        $ListStaffDepartment = User_infomation::where('rooms', $id)
            ->where('full_name', '!=', null)
            ->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $ListStaffDepartment = $ListStaffDepartment
                ->Where('id_number', $request->keyword)
                ->orWhere('nick_name','like', '%'.$request->keyword.'%')
                ->where('rooms', $id);
        };
        $ListStaffDepartment =  $ListStaffDepartment->paginate(15);
        return $ListStaffDepartment;
    }
}
