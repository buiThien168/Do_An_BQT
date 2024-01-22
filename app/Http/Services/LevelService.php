<?php

namespace App\Http\Services;

use App\Models\Level;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class LevelService
{
    public function getUsersListLevel()
    {
        $getUsers = User_infomation::where('level', '!=', null)->get('level');
        return $getUsers;
    }
    public function ListLevel($request)
    {
        $GetLevels = Level::where('deleted', 0)->orderBy('id', 'DESC');

        if (isset($request->keyword)) {
            $GetLevels = $GetLevels
                ->where('qualification_name', $request->keyword);
        }
        $GetLevels = $GetLevels->paginate(15);
        return $GetLevels;
    }
    public function PostAddLevel($request)
    {
        $PostAddLevel = Level::insert([
            'qualification_name' => $request->qualification_name,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updated_at' => null,
            'updater' => null,
            'deleted' => 0,
        ]);
        return $PostAddLevel;
    }
    public function GetLevelID($id)
    {
        $getLevel = Level::where('id', $id)->first();
        return $getLevel;
    }
    public function PostEditLevel($id, $request)
    {
        $PostEditLevel = Level::where('id', $id)->update([
            'qualification_name' => $request->qualification_name,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updated_at' => null,
            'updater' => null,
            'deleted' => 0,
        ]);
        return $PostEditLevel;
    }
    public function DeleteLevel($id){
        $DeleteLevel = Level::where('id',$id)->delete();
        return $DeleteLevel;
    }
    public function ListStaff($id,$request){
        $GetListStaffs = User_infomation::where('level',$id)
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
        return $GetListStaffs;
    }
}
