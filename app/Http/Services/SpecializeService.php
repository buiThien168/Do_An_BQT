<?php

namespace App\Http\Services;

use App\Models\Specialize;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class SpecializeService
{
    public function ListSpecialize($request)
    {
        $GetSpecializes = Specialize::where('deleted', 0)
            ->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $GetSpecializes = $GetSpecializes
                ->where('name_specializes','like', "%$request->keyword%");
        }
        $GetSpecializes = $GetSpecializes->paginate(15);
        return $GetSpecializes;
    }
    public function getSpecializeUser()
    {
        $getUsers = User_infomation::where('specializes', '!=', null)->get('specializes');
        return $getUsers;
    }
    public function PostAddSpecialize($request)
    {
        $PostAddSpecialize = Specialize::insert([
            'name_specializes' => $request->name_specializes,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updater' => null,
            'updated_at' => null,
            'deleted' => 0,
        ]);
        return $PostAddSpecialize;
    }
    public function getEditSpecialize($id)
    {
        $getSpecialize = Specialize::where('id', $id)->first();
        return $getSpecialize;
    }
    public function PostEditSpecialize($id, $request)
    {
        $PostEditSpecialize = Specialize::where('id', $id)->update([
            'name_specializes' => $request->name_specializes,
            'note' => $request->note,
            'created' => time(),
            'created_by' => Auth::user()->id,
            'updater' => null,
            'updated_at' => null,
            'deleted' => 0,
        ]);
        return  $PostEditSpecialize;
    }
    public function DeleteSpecialize($id){
        $DeleteSpecialize = Specialize::where('id',$id)->delete();
        return $DeleteSpecialize;
    }
    public function ListStaff($id, $request){
        $GetListStaffs= User_infomation::where('specializes',$id)
        ->where('full_name','!=',null)
        ->orderBy('id', 'DESC');
        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->Where('nick_name','like','%'.$request->keyword.'%')
            ->where('specializes',$id);
        };
        $GetListStaffs=$GetListStaffs->paginate(15);
        return $GetListStaffs;
    }
}
