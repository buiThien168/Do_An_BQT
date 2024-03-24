<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\User_infomation;
use App\Models\User_track;
use Carbon\Carbon;

class UserService
{
    public function addUser($request)
    {
        $user = new User();
        $user->name = $request->nick_name;
        $user->phone = $request->phone;
        $user->password = md5($request->password);
        $user->active = 1;
        $user->role = 2;
        $user->created_at = now();
        $user->is_deleted = 0;
        $user->save();
        $user_id = $user->id;
        return $user_id;
    }
    public function addUserInfomation($request, $user_id)
    {
        $userInformation = new User_infomation();
        $userInformation->user_id = $user_id;
        $userInformation->full_name = $request->full_name;
        $userInformation->nick_name = $request->nick_name;
        $userInformation->image = $request->image;
        $userInformation->email = $request->email;
        $userInformation->sex = $request->sex;
        $userInformation->date_of_birth = date(strtotime($request->date_of_birth));
        $userInformation->place_of_birth = $request->place_of_birth;
        $userInformation->marital_status = $request->marital_status;
        $userInformation->id_number = $request->id_number;
        if ($request->date_range !== null) {
            $userInformation->date_range = date(strtotime($request->date_range));
        } else {
            $userInformation->date_range = null;
        }
        $userInformation->passport_issuer = $request->passport_issuer;
        $userInformation->hometown = $request->hometown;
        $userInformation->nationality = $request->nationality;
        $userInformation->nation = $request->nation;
        $userInformation->religion = $request->religion;
        $userInformation->permanent_residence = $request->permanent_residence;
        $userInformation->staying = $request->staying;
        $userInformation->employee_type = $request->employee_type;
        $userInformation->level = $request->level;
        $userInformation->specializes = $request->specializes;
        $userInformation->rooms = $request->rooms;
        $userInformation->positions = $request->positions;
        $userInformation->status = 0;
        $userInformation->save();
    }
    public function ListStaffService($request)
    {
        $GetListStaffs = User_infomation::leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
        ->select('user_infomations.*','positions.name_position as position')->where('is_deleted', 0)->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetListStaffs->where(function ($query) use ($request) {
                $query->where('user_id', $request->keyword)
                    ->orWhere('id_number', $request->keyword)
                    ->orWhere('nick_name', 'LIKE', "%{$request->keyword}%")
                    ->where('full_name', '!=', null)
                    ->where('is_deleted', 0);
            });
        }
        $GetListStaffs = $GetListStaffs->paginate(15);
        return $GetListStaffs;
    }
    public function checkOnlineStaffService($request){
        $userTracksToday = User_track::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'user_tracks.user_id')
        ->whereDate('user_tracks.created_at', Carbon::today())
        ->select('user_tracks.*','user_infomations.full_name','user_infomations.image','user_infomations.email')
        ->distinct()
        ->get();
        $uniqueUsers = $userTracksToday->unique('user_id');
        return $uniqueUsers;
        
    }
    public function checkOffStaffService($request){
         $userTracksToday = User_track::whereDate('created_at', Carbon::today())->pluck('user_id');
        // $userTracksToday = User_track::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'user_tracks.user_id')
        // ->whereDate('user_tracks.created_at', Carbon::today())
        // ->select('user_tracks.*','user_infomations.full_name','user_infomations.image','user_infomations.email')
        // ->pluck('user_id');
        $allUsers = User::where('role', 2)->pluck('id');
        $usersNotCheckedToday = $allUsers->diff($userTracksToday);
        // $usersDetails = User::whereIn('id', $usersNotCheckedToday)->get();
        $usersDetails = User::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')->whereIn('users.id', $usersNotCheckedToday)
        ->select('user_infomations.*')
        ->get();
        return $usersDetails;
    }
    public function StaffDetailServices($id)
    {
        $GetStaffs = User_infomation::leftJoin('employee_types', 'employee_types.id', '=', 'user_infomations.employee_type')
            ->leftJoin('levels', 'levels.id', '=', 'user_infomations.level')
            ->leftJoin('specializes', 'specializes.id', '=', 'user_infomations.specializes')
            ->leftJoin('rooms', 'rooms.id', '=', 'user_infomations.rooms')
            ->leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
            ->leftJoin('users', 'users.id', '=', 'user_infomations.user_id')
            ->select(
                'user_infomations.*',
                'employee_types.name as employee_types',
                'levels.qualification_name as levels',
                'specializes.name_specializes as specializes',
                'rooms.room_name as rooms',
                'positions.name_position as positions',
                'users.phone as phone'
            )
            ->where('user_infomations.user_id', $id)
            ->first();
        return $GetStaffs;
    }
    public function EditStaffService($id, $request)
    {
        if ($request->date_range !== null) {
            $date_ranges = date(strtotime($request->date_range));
        } else {
            $date_ranges = null;
        }
        $EditStaffService = User_infomation::where('user_id', $id)->update([
            'nick_name' => $request->nick_name,
            'email' => $request->email,
            'sex' => $request->sex,
            'date_of_birth' => date(strtotime($request->date_of_birth)),
            'place_of_birth' => $request->place_of_birth,
            'marital_status' => $request->marital_status,
            'id_number' => $request->id_number,
            'date_range' => $date_ranges,
            'passport_issuer' => $request->passport_issuer,
            'hometown' => $request->hometown,
            'nationality' => $request->nationality,
            'nation' => $request->nation,
            'religion' => $request->religion,
            'permanent_residence' => $request->permanent_residence,
            'staying' => $request->staying,
            'employee_type' => $request->employee_type,
            'level' => $request->level,
            'specializes' => $request->specializes,
            'rooms' => $request->rooms,
            'positions' => $request->positions

        ]);

        return $EditStaffService;
    }
    public function DeleteStaffService($id)
    {
        try {
            User::where('id', $id)->delete();
            User_infomation::where('user_id', $id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function UpdateImageStaffService($id, $images)
    {
        $images = User_infomation::where('user_id', $id)->update([
            'image' => $images
        ]);
        return $images;
    }
    public function UpdatePasswordService($request, $id)
    {
        $password = User::where('id', $id)->update([
            'password' => md5($request->password)
        ]);
        return $password;
    }
    public function UpdatePhoneService($request, $id)
    {
        $phone = User::where('id', $id)->update([
            'phone' => $request->phone
        ]);
        return $phone;
    }
    public function ListUserServices()
    {
        $GetUsers = User::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->select('user_infomations.full_name', 'users.*', 'user_infomations.image', 'user_infomations.email')
            ->where('users.is_deleted', 0)
            ->where('users.role', 2)
            ->orderBy('users.id', 'DESC')
            ->paginate(10);
        return $GetUsers;
    }
    public function SearchUserServices($request)
    {
        $GetUsers = User::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->select('user_infomations.full_name', 'users.*', 'user_infomations.image', 'user_infomations.email')
            ->where('users.is_deleted', 0)
            ->where('users.role', 2)
            ->where(function ($query) use ($request) {
                $query->where('users.name', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('userInformation', function ($query) use ($request) {
                        $query->where('full_name', 'like', '%' . $request->keyword . '%');
                    });
            })
            ->orderBy('users.id', 'DESC')
            ->paginate(10);
        return $GetUsers;
    }
}
