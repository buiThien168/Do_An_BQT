<?php

namespace App\Http\Controllers\Staff\Face;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
// use Session;
use Illuminate\Support\Facades\Session;


class FaceController extends Controller
{   
    public function FaceStaffDetail(){
        $getImages= DB::table('user_face')->where('user_id',Auth::user()->id)->get();
        return view('Staff.Face.FaceStaffDetail',
            [
                'getImages'=>$getImages,
            ]
        );
    }



    public function ConfirmFace(){
        Session::put('confirm_face', 'ok');
        return redirect(url('kenh-giao-hang/account-information'));
    }
    public function RegisterFace(){
        $checkHaveFace = DB::table('user_face')->where('user_id',Auth::user()->id)
        ->orderBy('id','desc')
        ->first();
        if($checkHaveFace == null){
            return view('Staff.RegisterFace.Index');
        }else{
            return redirect('account-information');
        }   
    }

    public function PostRegisterFace(Request $request){
        $getMax = DB::table('user_face')->where('user_id',Auth::user()->id)
        ->orderBy('id','desc')
        ->first();

        $getFullName = DB::table('user_infomations')->where('user_id',Auth::user()->id)->first('full_name');
        if($getMax == null){
            $getMax=1;
        }else{
            $getMax = $getMax->order_by+1;
        }
        $image_64 = $request->image;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = $getMax.'.jpg';
        Storage::put('public/face-data/'.$getFullName->full_name.'/'.$imageName, base64_decode($image));

        DB::table('user_face')->insert(['image'=>$imageName,'name'=>$getFullName->full_name,'order_by'=>$getMax,'created_at'=>time(),'user_id'=>Auth::user()->id]);
    }



    public function RecordFace(){
        Session::put('first_name', "ok");
        $getUsers =DB::table('users')
        ->leftJoin('user_face','user_face.user_id','users.id')
        ->where('users.role',2)
        ->where('users.is_deleted',0)
        ->select('user_face.name')
        ->where('user_face.name','!=',null)
        ->groupBy('user_face.name')
        ->get();
        $getUsersJson = json_encode($getUsers);
         return view('Staff.CheckFace.Index',['getUsers'=>$getUsers]);
    }

    public function PostRecordFace(Request $request){

        // $getUser = User_infomation::where('full_name', $request->name)->first('user_id');
        // if (Session::get('first_name') != $request->name) {
        //     // $checkType = DB::table('user_track')->where('user_id',$getUser->user_id)->orderBy('id','desc')->first();
        //     $checkType = User_track::where('user_id', $getUser->user_id)->orderBy('id', 'desc')->first();
        //     if($checkType){
        //         $checkTimestamp = $checkType->created_at->timestamp;
        //         $currentTime = now()->timestamp;
        //         if (Carbon::today()->isSameDay($checkType->created_at) && ($currentTime - $checkTimestamp) > (30 * 60)) {
        //             $type = 1;
        //             User_track::where('user_id', $getUser->user_id)->update([
        //                 'user_id' => $getUser->user_id,
        //                 'type' => $type,
        //                 'updated_at' => now()
        //             ]);
        //         } else {
        //             $type = 1;
        //             User_track::insert([
        //                 'user_id' => $getUser->user_id,
        //                 'type' => $type,
        //                 'created_at' => now()
        //             ]);
        //         }
        //         Session::put('first_name', $request->name);
        //         if ($type == 0) {
        //             $time = $request->name . " - Hour in " . Carbon::now('Asia/Ho_Chi_Minh');
        //         } else {
        //             $time = $request->name . " - Hour out " . Carbon::now('Asia/Ho_Chi_Minh');
        //         }
        //     }

        $getUser = DB::table('user_infomations')->where('full_name',$request->name)->first('user_id');
        if(Session::get('first_name') != $request->name){
            $checkType = DB::table('user_track')->where('user_id',$getUser->user_id)->orderBy('id','desc')->first();

            if($checkType == null){
                $type=0;
            }else{
                if($checkType->type ==0){
                    $type=1;
                }else if($checkType->type ==1 ){
                    $type=0;
                }
            }
            
            DB::table('user_track')->insert(
                [
                    'user_id'=>$getUser->user_id,
                    'type' => $type,
                    'created_at'=>time()
                ]
            );
            Session::put('first_name', $request->name);
            if($type == 0){
                $time= $request->name." - Hour in ".Carbon::now('Asia/Ho_Chi_Minh');
            }else{
                $time= $request->name." - Hour out ".Carbon::now('Asia/Ho_Chi_Minh');
            }
            
            echo $time;
        }else{
            echo "Staff ".$request->name." successfully identified, please invite the next person";
        }
        
    }
    
    
    
    
}
