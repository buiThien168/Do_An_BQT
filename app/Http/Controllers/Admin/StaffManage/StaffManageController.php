<?php

namespace App\Http\Controllers\Admin\StaffManage;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use App\Models\Employee_type;
use App\Models\Level;
use App\Models\Position;
use App\Models\Room;
use App\Models\Specialize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Log;
class StaffManageController extends Controller
{
    protected $UserService;
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }
    // xóa nhân viên
    public function DeleteStaff($id)
    {
       $this->UserService->DeleteStaffService($id);
        return back();
    }
    // edit nhân viên
    public function PostEditStaff($id, Request $request)
    {
        $validate = $request->validate([
            'full_name' => 'required|max:255',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'sex' => 'required|integer',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|max:255',
            'marital_status' => 'required|integer',
            'id_number' => 'nullable|integer',
            'date_range' => 'nullable|date',
            'passport_issuer' => 'nullable|max:255',
            'hometown' => 'nullable|max:255',
            'nationality' => 'nullable|max:255',
            'nation' => 'nullable|max:255',
            'religion' => 'nullable|max:255',
            'permanent_residence' => 'nullable|max:255',
            'staying' => 'nullable|max:255',
            'employee_type' => 'required|integer',
            'level' => 'required|integer',
            'specializes' => 'required|integer',
            'rooms' => 'required|integer',
            'positions' => 'required|integer',
        ]);
        try{
            DB::beginTransaction();
            if (isset($request->image)) {
                $new_name = rand() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/staff/'), $new_name);
                $request->image = $new_name;
                $images = $request->image;
                $this->UserService->UpdateImageStaffService($id,$images);
            }
            if (isset($request->password)) {
                $this->UserService->UpdatePasswordService($request,$id);
            }
            if(isset($request->phone)){
                $this->UserService->UpdatePhoneService($request,$id);
            }
            $this->UserService->EditStaffService($id,$request);
            DB::commit();
            return redirect('admin/user-management');
        }catch(\Exception $e){
            Log::error('Error occurred: ' . $e->getMessage());
            DB::rollBack();
        }
    }
    // edit nhân viên
    public function EditStaff($id)
    {
        $getStaff = User_infomation::with('user')->where('user_id', $id)->first();
        $employee_type = Employee_type::get();
        $level = Level::get();
        $specializes = Specialize::get();
        $rooms = Room::get();
        $positions = Position::get();
        return view('Admin.StaffManage.EditStaff', ['getStaff' => $getStaff, 'employee_type' => $employee_type, 'level' => $level, 'specializes' => $specializes, 'rooms' => $rooms, 'positions' => $positions, 'id' => $id]);
    }
    // form nhân viên
    public function AddStaff()
    {

        $employee_type = Employee_type::get();
        $level = Level::get();
        $specializes = Specialize::get();
        $rooms = Room::get();
        $positions = Position::get();
        return view('Admin.StaffManage.AddStaff', ['employee_type' => $employee_type, 'level' => $level, 'specializes' => $specializes, 'rooms' => $rooms, 'positions' => $positions]);
    }
    // Thêm nhân viên
    public function PostAddStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'full_name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'password' => 'required|min:6|max:50',
            'sex' => 'required|integer',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|max:255',
            'marital_status' => 'required|integer',
            'id_number' => 'nullable',
            'date_range' => 'nullable|date',
            'passport_issuer' => 'nullable|max:255',
            'hometown' => 'nullable|max:255',
            'nationality' => 'nullable|max:255',
            'nation' => 'nullable|max:255',
            'religion' => 'nullable|max:255',
            'permanent_residence' => 'nullable|max:255',
            'staying' => 'nullable|max:255',
            'employee_type' => 'required|integer',
            'level' => 'required|integer',
            'specializes' => 'required|integer',
            'rooms' => 'required|integer',
            'positions' => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $checkUser = User::where('phone', $request->phone)->first();
            if ($checkUser == null) {
                if (isset($request->image)) {
                    $new_name = rand() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('images/staff/'), $new_name);
                     $request->image = $new_name;
                }
                try{
                    DB::beginTransaction();
                    $user_id = $this->UserService->addUser($request);
                    $this->UserService->addUserInfomation($request, $user_id);
                    DB::commit();
                    return redirect('admin/user-management');
                }catch(\Exception $e){
                    DB::rollBack();
                    Log::error('Error occurred: ' . $e->getMessage());
                    return redirect()->back()->with('msg', 'Error');
                }
            } else {
                return redirect()->back()->with('msg', 'Điện thoại đã tồn tại');
            }
        }
    }
    // danh sách nhân viên
    public function ListStaff(Request $request)
    {
        $ListStaff = $this->UserService->ListStaffService($request);
        $checkOnlineStaff = $this->UserService->checkOnlineStaffService($request);
        $checkOffStaff = $this->UserService->checkOffStaffService($request);
        $checkWorkSuccessService = $this->UserService->checkWorkSuccessService($request);
        $checkWork = $this->UserService->checkWorkService($request);
        return view(
            'Admin.StaffManage.ListStaff',
            [
                'GetListStaffs' => $ListStaff,
                'checkOnlineStaff'=>$checkOnlineStaff,
                'checkOffStaff' =>$checkOffStaff,
                'checkWorkSuccessService'=>$checkWorkSuccessService,
                'checkWork'=>$checkWork
            ]
        );
    }
    // chi tiết nhân viên
    public function StaffDetail($id)
    {
        $GetStaffs = $this->UserService->StaffDetailServices($id);
        return view(
            'Admin.StaffManage.StaffDetail',
            [
                'GetStaffs' => $GetStaffs,
            ]
        );
    }
    // mở khóa nhân viên
    public function BlockUnBlockUser($id)
    {
        $getUser = User::where('id', $id)->first();
        if ($getUser != null) {
            if ($getUser->active == 0) {
                User::where('id', $id)->update([
                    'active' => 1, 
                    'updated_at' => now()
                ]);
                return back();
            } else if ($getUser->active == 1) {
                User::where('id', $id)->update([
                    'active' => 0, 
                    'updated_at' => now()
                ]);
                return back();
            }
        }
    }
}
