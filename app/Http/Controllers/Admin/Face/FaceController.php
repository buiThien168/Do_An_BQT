<?php

namespace App\Http\Controllers\Admin\Face;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FaceController extends Controller
{   
    public function ResetFaceStaff($id){
        DB::table('user_face')->where('user_id',$id)->delete();
        return back();
    }
    public function FaceStaffDetail($id){
        $getImages= DB::table('user_face')->where('user_id',$id)->get();
        return view('Admin.Face.FaceStaffDetail',
            [
                'getImages'=>$getImages,
            ]
        );
    }
    public function ListFaceStaff(Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('full_name','!=',null)
        ->orderBy('id', 'DESC');


        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->where('user_id',$request->keyword)
            ->orWhere('id_number',$request->keyword)
            ->orWhere('full_name',$request->keyword);
        }
        $GetListStaffs=$GetListStaffs->paginate(15);


        return view('Admin.Face.ListFaceStaff',
            [
                'GetListStaffs'=>$GetListStaffs,
            ]
        );
    }
    
    
}
