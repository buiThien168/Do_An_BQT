<?php

namespace App\Http\Controllers\Admin\Face;

use App\Http\Controllers\Controller;
use App\Http\Services\FaceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FaceController extends Controller
{  
    protected $FaceService;
    public function __construct(FaceService $FaceService)
    {
        $this->FaceService = $FaceService;
    } 
    public function ResetFaceStaff($id){
        $this->FaceService->ResetFaceStaff($id);
        return back();
    }
    public function FaceStaffDetail($id){
        $getImages =  $this->FaceService->FaceStaffDetail($id);
        return view('Admin.Face.FaceStaffDetail',
            [
                'getImages'=>$getImages,
            ]
        );
    }
    public function ListFaceStaff(Request $request){
        
        $GetListStaffs =  $this->FaceService->ListFaceStaff($request);
        return view('Admin.Face.ListFaceStaff',
            [
                'GetListStaffs'=>$GetListStaffs,
            ]
        );
    }
    
    
}
