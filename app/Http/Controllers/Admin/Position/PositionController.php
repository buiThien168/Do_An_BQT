<?php

namespace App\Http\Controllers\Admin\Position;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PositionController extends Controller
{   

    public function ListStaff($id,Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('positions',$id)
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

    public function DeletePosition($id){
        DB::table('positions')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/position-management');
    }

    public function ListPosition(Request $request){
        $GetPositions = DB::table('positions')
        ->where('deleted',0)
        ->orderBy('id', 'DESC');

        if(isset($request->keyword)){
            $GetPositions=$GetPositions
            ->where('name_position',$request->keyword);
        }
        $GetPositions=$GetPositions->paginate(15);

        $getUsers = DB::table('user_infomations')->where('positions','!=',null)->get('positions');

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
        DB::table('positions')->insert(
            [   
                'name_position'=>$request->name_position,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/position-management');
    }

    public function EditPosition($id){
        $getPosition = DB::table('positions')->where('id',$id)->first();
        return view('Admin.Position.EditPosition',['getPosition'=>$getPosition,'id'=>$id]);
    }
    public function PostEditPosition($id,Request $request){
        $validate = $request->validate([
            'name_position' => 'required|max:255',
            'note'=>'max:255'
        ]);
        DB::table('positions')->where('id',$id)->update(
            [   
                'name_position'=>$request->name_position,
                'note'=>$request->note,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/position-management');
    }

    
}
