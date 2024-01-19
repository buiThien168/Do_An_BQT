<?php

namespace App\Http\Controllers\Admin\StaffManage;

use App\Http\Controllers\Controller;
use App\Models\Employee_type;
use App\Models\Level;
use App\Models\Position;
use App\Models\Room;
use App\Models\Specialize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\User;

class StaffManageController extends Controller
{   

    public function DeleteStaff($id){
        // DB::table('users')->where('id',$id)->update(['is_deleted'=>1]);
        // DB::table('user_infomations')->where('user_id',$id)->update(['is_deleted'=>1]);
        DB::table('users')->where('id',$id)->delete();
        DB::table('user_infomations')->where('user_id',$id)->delete();
        return back();
    }
    public function PostEditStaff($id,Request $request){
        $validate = $request->validate([

            'nick_name' => 'required|max:255',
            'phone'=>'required|digits:10',
            'email'=>'required|email',
            'sex'=>'required|integer',
            'date_of_birth'=>'required|date',
            'place_of_birth'=>'required|max:255',
            'marital_status'=>'required|integer',
            'id_number'=>'required|integer',
            'date_range'=>'required|date',
            'passport_issuer'=>'required|max:255',
            'hometown'=>'required|max:255',
            'nationality'=>'required|max:255',
            'nation'=>'required|max:255',
            'religion'=>'required|max:255',
            'permanent_residence'=>'required|max:255',
            'staying'=>'required|max:255',
            'employee_type'=>'required|integer',
            'level'=>'required|integer',
            'specializes'=>'required|integer',
            'rooms'=>'required|integer',
            'positions'=>'required|integer',
        ]);
        
        if(isset($request->image)){
            $new_name = rand() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/staff/'), $new_name);
            $request->image=$new_name;
            DB::table('user_infomations')->where('id',$id)->update(
                [
                    'image'=>$request->image,
                ]
            );
        }
        if(isset($request->password)){
            DB::table('users')->where('id',$id)(
                [
                    'password'=>md5($request->password),
                ]
            );
        }



        DB::table('user_infomations')->where('id',$id)->update(
            [   
                'nick_name'=>$request->nick_name,
                'email'=>$request->email,
                'sex'=>$request->sex,
                'date_of_birth'=>date(strtotime($request->date_of_birth)),
                'place_of_birth'=>$request->place_of_birth,
                'marital_status'=>$request->maritalstatus,
                'id_number'=>$request->id_number,
                'date_range'=>date(strtotime($request->date_range)),
                'passport_issuer'=>$request->passport_issuer,
                'hometown'=>$request->hometown,
                'nationality'=>$request->nationality,
                'nation'=>$request->nation,
                'religion'=>$request->religion,
                'permanent_residence'=>$request->permanent_residence,
                'staying'=>$request->staying,
                'employee_type'=>$request->employee_type,
                'level'=>$request->level,
                'specializes'=>$request->specializes,
                'rooms'=>$request->rooms,
                'positions'=>$request->positions,
            ]
        ); 
        return redirect('admin/user-management');
    }

    public function EditStaff($id){
        $getStaff = DB::table('user_infomations')
        ->leftJoin('users','users.id','user_infomations.user_id')
        ->select('user_infomations.*','users.phone')
        ->where('user_infomations.id',$id)->first();

        $employee_type = DB::table('employee_type')->get();
        $level=DB::table('level')->get();
        $specializes=DB::table('specializes')->get();
        $rooms=DB::table('rooms')->get();
        $positions=DB::table('positions')->get();
        return view('Admin.StaffManage.EditStaff',['getStaff'=>$getStaff,'employee_type'=>$employee_type,'level'=>$level,'specializes'=>$specializes,'rooms'=>$rooms,'positions'=>$positions,'id'=>$id]);
    }
    public function AddStaff(){
        $employee_type = Employee_type::get();
        $level=Level::get();
        $specializes=Specialize::get();
        $rooms=Room::get();
        $positions=Position::get();
        return view('Admin.StaffManage.AddStaff',['employee_type'=>$employee_type,'level'=>$level,'specializes'=>$specializes,'rooms'=>$rooms,'positions'=>$positions]);
    }

    public function PostAddStaff(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'nick_name' => 'required|max:255',
            'image'=>'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048',
            'phone'=>'required|digits:10',
            'email'=>'required|email',
            'password'=>'required|min:6|max:50',
            'sex'=>'required|integer',
            'date_of_birth'=>'required|date',
            'place_of_birth'=>'required|max:255',
            'marital_status'=>'required|integer',
            'id_number'=>'required|integer',
            'date_range'=>'required|date',
            'passport_issuer'=>'required|max:255',
            'hometown'=>'required|max:255',
            'nationality'=>'required|max:255',
            'nation'=>'required|max:255',
            'religion'=>'required|max:255',
            'permanent_residence'=>'required|max:255',
            'staying'=>'required|max:255',
            'employee_type'=>'required|integer',
            'level'=>'required|integer',
            'specializes'=>'required|integer',
            'rooms'=>'required|integer',
            'positions'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }else{
            $checkUser = DB::table('users')->where('users.phone',$request->phone)->first();
            if($checkUser == null){
                if(isset($request->image)){
                    $new_name = rand() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('images/staff/'), $new_name);
                    $request->image=$new_name;
                }
                $user_id = DB::table('users')->insertGetId(
                    [   
                        'name'=>$request->full_name,
                        'phone'=>$request->phone,
                        'password'=>md5($request->password),
                        'active'=>1,
                        'role'=>2,
                        'created_at'=>time()
                    ]
                );
                DB::table('user_infomations')->insert(
                    [   
                        'user_id'=>$user_id,
                        'full_name'=>$request->full_name,
                        'nick_name'=>$request->nick_name,
                        'image'=>$request->image,
                        'email'=>$request->email,
                        'sex'=>$request->sex,
                        'date_of_birth'=>date(strtotime($request->date_of_birth)),
                        'place_of_birth'=>$request->place_of_birth,
                        'marital_status'=>$request->marital_status,
                        'id_number'=>$request->id_number,
                        'date_range'=>date(strtotime($request->date_range)),
                        'passport_issuer'=>$request->passport_issuer,
                        'hometown'=>$request->hometown,
                        'nationality'=>$request->nationality,
                        'nation'=>$request->nation,
                        'religion'=>$request->religion,
                        'permanent_residence'=>$request->permanent_residence,
                        'staying'=>$request->staying,
                        'employee_type'=>$request->employee_type,
                        'level'=>$request->level,
                        'specializes'=>$request->specializes,
                        'rooms'=>$request->rooms,
                        'positions'=>$request->positions,
                        'status'=>0
                    ]
                ); 
                return redirect('admin/user-management');
            }else{
                return redirect()->back()->with('msg', 'Phone already exists');
            }
        } 
    }

    public function ListStaff(Request $request){
        $GetListStaffs = DB::table('user_infomations')
        ->where('full_name','!=',null)
        ->where('is_deleted',0)
        ->orderBy('id', 'DESC');


        if(isset($request->keyword)){
            $GetListStaffs=$GetListStaffs
            ->where('user_id',$request->keyword)
            ->orWhere('id_number',$request->keyword)
            ->where('full_name','!=',null)
            ->where('is_deleted',0)
            ->orWhere('full_name',$request->keyword)
            ->where('full_name','!=',null)
            ->where('is_deleted',0);
        }
        $GetListStaffs=$GetListStaffs->paginate(15);


        return view('Admin.StaffManage.ListStaff',
            [
                'GetListStaffs'=>$GetListStaffs,
            ]
        );
    }

    public function StaffDetail($id){
        $GetStaffs = DB::table('user_infomations')
        ->leftJoin('employee_type','employee_type.id','user_infomations.employee_type')
        ->leftJoin('level','level.id','user_infomations.level')
        ->leftJoin('specializes','specializes.id','user_infomations.specializes')
        ->leftJoin('rooms','rooms.id','user_infomations.rooms')
        ->leftJoin('positions','positions.id','user_infomations.positions')
        ->leftJoin('users','users.id','user_infomations.user_id')
        ->select('user_infomations.*','employee_type.name as employee_type','level.qualification_name as level','specializes.name_specializes as specializes','rooms.room_name as rooms','positions.name_position as positions','users.phone as phone')
        ->where('user_infomations.id', $id)
        ->first();


        return view('Admin.StaffManage.StaffDetail',
            [
                'GetStaffs'=>$GetStaffs,
            ]
        );
    }

    public function BlockUnBlockUser($id){

        $getUser = DB::table('users')->where('id',$id)->first();

        if($getUser != null){
            if($getUser->active == 0){
                DB::table('users')->where('id',$id)->update(['active'=>1,'updated_at'=>time()]);
                return back();
            }else if($getUser->active == 1){
                DB::table('users')->where('id',$id)->update(['active'=>0,'updated_at'=>time()]);
                return back();
            }             
        }

        
    }
}
