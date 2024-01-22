<?php

namespace App\Http\Controllers\Admin\Position;

use App\Http\Controllers\Controller;
use App\Http\Services\PositionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PositionController extends Controller
{   
    protected $PositionService;
    public function __construct(PositionService $PositionService)
    {
        $this->PositionService = $PositionService;
    }
    public function ListStaff($id,Request $request){
        $GetListStaffs= $this->PositionService->ListPosition($id,$request);
        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }

    public function DeletePosition($id){
        $this->PositionService->DeletePosition($id);
        return redirect('admin/position-management');
    }

    public function ListPosition(Request $request){
        $GetPositions = $this->PositionService->GetIFPostionList($request);
        $getUsers = $this->PositionService->GetIFoUser();
        return view('Admin.Position.ListPosition',
            [
                'GetPositions'=>$GetPositions,
                'getUsers'=>$getUsers
            ]
        );
    }
    public function AddPosition(){
        return view('Admin.Position.AddPosition');
    }

    public function PostAddPosition(Request $request){
        $validate = $request->validate([
            'name_position' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->PositionService->AddPosition($request);
        return redirect('admin/position-management');
    }

    public function EditPosition($id){
        $getPosition = $this->PositionService->GetIFoPostion($id);
        return view('Admin.Position.EditPosition',['getPosition'=>$getPosition,'id'=>$id]);
    }
    public function PostEditPosition($id,Request $request){
        $validate = $request->validate([
            'name_position' => 'required|max:255',
            'note'=>'max:255'
        ]);
        $this->PositionService->PostEditPosition($id,$request);
        return redirect('admin/position-management');
    }

    
}
