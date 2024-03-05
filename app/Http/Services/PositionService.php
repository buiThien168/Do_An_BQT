<?php

namespace App\Http\Services;

use App\Models\Position;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class PositionService
{
    public function GetIFoPostion($id)
    {
        $getPosition = Position::where('id', $id)->first();
        return $getPosition;
    }
    public function GetIFoUser()
    {
        $getUsers = User_infomation::where('positions', '!=', null)->get('positions');
        return $getUsers;
    }
    public function ListPosition($id, $request)
    {
        $GetListStaffs = User_infomation::where('positions', $id)
            ->where('full_name', '!=', null)
            ->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetListStaffs = $GetListStaffs
                ->where('user_id', $request->keyword)
                ->orWhere('id_number', $request->keyword)
                ->where('rooms', $id)
                ->where('full_name', '!=', null)
                ->orWhere('full_name', $request->keyword)
                ->where('rooms', $id)
                ->where('full_name', '!=', null);
        };
        $GetListStaffs = $GetListStaffs->paginate(15);
        return $GetListStaffs;
    }
    public function AddPosition($request)
    {
        $AddPosition = Position::insert([
            'name_position' => $request->name_position,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
        ]);
        return $AddPosition;
    }
    public function GetIFPostionList($request)
    {
        $GetPositions = Position::where('deleted', 0)->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetPositions = $GetPositions->where('name_position','like', "%$request->keyword%");
        }
        $GetPositions = $GetPositions->paginate(15);
        return $GetPositions;
    }
    public function PostEditPosition($id, $request)
    {
        $EditPosition = Position::where('id', $id)->update([

            'name_position' => $request->name_position,
            'note' => $request->note,
            'created' => time(),
            'luong_ngay' => null,
            'created_by' => Auth::user()->id,
            'updated_at' => null,
            'updater' => null,
            'deleted' => 0,
        ]);
        return $EditPosition;
    }
    public function DeletePosition($id){
        $DeletePosition = Position::where('id',$id)->delete();
        return $DeletePosition;
    }
}
