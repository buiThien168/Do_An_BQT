<?php

namespace App\Http\Controllers\Admin\Level;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LevelController extends Controller
{   

    public function ListStaff($id,Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('level',$id)
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

    public function DeleteLevel($id){
        DB::table('level')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/level-management');
    }

    public function ListLevel(Request $request){
        $GetLevels = DB::table('level')
        ->where('deleted',0)
        ->orderBy('id', 'DESC');

        if(isset($request->keyword)){
            $GetLevels=$GetLevels
            ->where('qualification_name',$request->keyword);
        }
        $GetLevels=$GetLevels->paginate(15);

        $getUsers = DB::table('user_infomations')->where('level','!=',null)->get('level');

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
        DB::table('level')->insert(
            [   
                'qualification_name'=>$request->qualification_name,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/level-management');
    }

    public function EditLevel($id){
        $getLevel = DB::table('level')->where('id',$id)->first();
        return view('Admin.Level.EditLevel',['getLevel'=>$getLevel,'id'=>$id]);
    }
    public function PostEditLevel($id,Request $request){
        $validate = $request->validate([
            'qualification_name' => 'required|max:255',
            'note'=>'max:255'
        ]);
        DB::table('level')->where('id',$id)->update(
            [   
                'qualification_name'=>$request->qualification_name,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/level-management');
    }

    
}
