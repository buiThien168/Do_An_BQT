<?php

namespace App\Http\Controllers\Admin\Specialize;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SpecializeController extends Controller
{   
    public function ListStaff($id,Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('specializes',$id)
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

        return view('Admin.StaffManage.ListStaffDetail',
            [
                'GetListStaffs'=>$GetListStaffs

            ]
        );
    }

    public function DeleteSpecialize($id){
        DB::table('specializes')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/professional-management');
    }

    public function ListSpecialize(Request $request){
        $GetSpecializes = DB::table('specializes')
        ->where('deleted',0)
        ->orderBy('id', 'DESC');

        if(isset($request->keyword)){
            $GetSpecializes=$GetSpecializes
            ->where('name_specializes',$request->keyword);
        }
        $GetSpecializes=$GetSpecializes->paginate(15);

        $getUsers = DB::table('user_infomations')->where('specializes','!=',null)->get('specializes');

        return view('Admin.Specialize.ListSpecialize',
            [
                'GetSpecializes'=>$GetSpecializes,
                'getUsers'=>$getUsers
            ]
        );
    }
    public function AddSpecialize(){
        return view('Admin.Specialize.AddSpecialize');
    }

    public function PostAddSpecialize(Request $request){
        $validate = $request->validate([
            'name_specializes' => 'required|max:255',
            'note'=>'max:255'
        ]);
        DB::table('specializes')->insert(
            [   
                'name_specializes'=>$request->name_specializes,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/professional-management');
    }

    public function EditSpecialize($id){
        $getSpecialize = DB::table('specializes')->where('id',$id)->first();
        return view('Admin.Specialize.EditSpecialize',['getSpecialize'=>$getSpecialize,'id'=>$id]);
    }
    public function PostEditSpecialize($id,Request $request){
        $validate = $request->validate([
            'name_specializes' => 'required|max:255',
            'note'=>'max:255'
        ]);
        DB::table('specializes')->where('id',$id)->update(
            [   
                'name_specializes'=>$request->name_specializes,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/professional-management');
    }

    
}
