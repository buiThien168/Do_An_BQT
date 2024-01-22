<?php

namespace App\Http\Controllers\Admin\Level;

use App\Http\Controllers\Controller;
use App\Http\Services\LevelService;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\User_infomation;

class LevelController extends Controller
{   
    protected $LevelService;
    public function __construct(LevelService $LevelService)
    {
        $this->LevelService = $LevelService;
    }
    public function ListStaff($id,Request $request){
       $GetListStaffs = $this->LevelService->ListStaff($id,$request);
        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }

    public function DeleteLevel($id){
        $this->LevelService->DeleteLevel($id);
        return redirect('admin/level-management');
    }

    public function ListLevel(Request $request){
        $GetLevels = $this->LevelService->ListLevel($request);
        $getUsers = $this->LevelService->getUsersListLevel($request);
        return view('Admin.Level.ListLevel',
            [
                'GetLevels'=>$GetLevels,
                'getUsers'=>$getUsers
            ]
        );
    }
    public function AddLevel(){
        return view('Admin.Level.AddLevel');
    }

    public function PostAddLevel(Request $request){
        $validate = $request->validate([
            'qualification_name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->LevelService->PostAddLevel($request);
        return redirect('admin/level-management');
    }

    public function EditLevel($id){
        $getLevel = $this->LevelService->GetLevelID($id);
        return view('Admin.Level.EditLevel',['getLevel'=>$getLevel,'id'=>$id]);
    }
    public function PostEditLevel($id,Request $request){
        $validate = $request->validate([
            'qualification_name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->LevelService->PostEditLevel($id,$request);
        return redirect('admin/level-management');
    }

    
}
