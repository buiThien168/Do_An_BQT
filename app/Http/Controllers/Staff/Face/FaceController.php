<?php

namespace App\Http\Controllers\Staff\Face;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\StaffFaceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\User_infomation;
use App\Models\User_track;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
// use Session;
use Illuminate\Support\Facades\Session;


class FaceController extends Controller
{
    protected $StaffFaceService;
    public function __construct(StaffFaceService $StaffFaceService)
    {
        $this->StaffFaceService = $StaffFaceService;
    }
    public function FaceStaffDetail()
    {
        $getImages = $this->StaffFaceService->FaceStaffDetail();
        return view(
            'Staff.Face.FaceStaffDetail',
            [
                'getImages' => $getImages,
            ]
        );
    }



    public function ConfirmFace()
    {
        Session::put('confirm_face', 'ok');
        return redirect(url('kenh-giao-hang/account-information'));
    }
    public function RegisterFace()
    {
        $checkHaveFace = $this->StaffFaceService->RegisterFace();
        if ($checkHaveFace == null) {
            return view('Staff.RegisterFace.Index');
        } else {
            return redirect('identity-management');
        }
    }

    public function PostRegisterFace(Request $request)
    {
        $getMax = $this->StaffFaceService->RegisterFace();
        $getFullName =  $this->StaffFaceService->getFullNameRegisterFace();
        if ($getMax == null) {
            $getMax = 1;
        } else {
            $getMax = $getMax->order_by + 1;
        }
        $image_64 = $request->image;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = $getMax . '.jpg';
        Storage::put('public/face-data/' . $getFullName->full_name . '/' . $imageName, base64_decode($image));
        $this->StaffFaceService->PostRegisterFace($imageName, $getFullName, $getMax);
    }



    public function RecordFace()
    {
        Session::put('first_name', "ok");
        $getUsers = User::leftJoin('user_faces', 'user_faces.user_id', 'users.id')
            ->where('users.role', 2)
            ->where('users.is_deleted', 0)
            ->select('user_faces.name')
            ->where('user_faces.name', '!=', null)
            ->groupBy('user_faces.name')
            ->get();
        $getUsersJson = json_encode($getUsers);
        return view('Staff.CheckFace.Index', ['getUsers' => $getUsers]);
    }

    public function PostRecordFace(Request $request)
    {
        $getUser = User_infomation::where('full_name', $request->name)->first('user_id');
        if (Session::get('first_name') != $request->name) {
            $checkType = User_track::where('user_id', $getUser->user_id)->latest()->orderBy('id', 'desc')->first();
            if ($checkType && Carbon::today()->isSameDay($checkType->created_at)) {
                $checkTimestamp = $checkType->created_at->timestamp;
                $currentTime = now()->timestamp;
                if ($checkType->type == 0 && Carbon::today()->isSameDay($checkType->created_at) && ($currentTime - $checkTimestamp) < (5 * 60)) {
                    Session::put('first_name', "da_hop_le_");
                    echo "Staff " . $request->name . " Đã hợp lệ xin cảm ơn!";
                    return;
                } else if($checkType->type == 1 && Carbon::today()->isSameDay($checkType->created_at)){
                    Session::put('first_name', "da_hop_le");
                    echo "Staff " . $request->name . " Đã hợp lệ xin cảm ơn!";
                    return;
                }else {
                    $type = 1;
                    User_track::insert([
                        'user_id' => $getUser->user_id,
                        'type' => $type,
                        'created_at' => time()
                    ]);
                    Session::put('first_name', $request->name);
                    $time = $request->name . " - Giờ ra " . Carbon::now('Asia/Ho_Chi_Minh');
                    echo $time;
                    sleep(1);
                    return;
                }
            } else {
                $type = 0;
                User_track::insert([
                    'user_id' => $getUser->user_id,
                    'type' => $type,
                    'created_at' => time()
                ]);
                Session::put('first_name', $request->name);
                $time = $request->name . " - Giờ vào " . Carbon::now('Asia/Ho_Chi_Minh');
                echo $time;
                sleep(1);
                return;
            }
        }else{
            echo "Staff " . $request->name . "Đã xác định thành công, vui lòng mời người tiếp theo";
        }
        // create a new 
        // $getUser = User_infomation::where('full_name', $request->name)->first('user_id');
        // if (Session::get('first_name') != $request->name) {
        //    $checkType = User_track::where ('user_id', $getUser->user_id)->orderBy('id', 'desc')->first();

        //     if ($checkType == null) {
        //         $type = 0;
        //     } else {
        //         if ($checkType->type == 0) {
        //             $type = 1;
        //         } else if ($checkType->type == 1) {
        //             $type = 0;
        //         }
        //     }

        //     User_track::insert([
        //         'user_id' => $getUser->user_id,
        //         'type' => $type,
        //         'created_at' => time()
        //     ]);
        //     Session::put('first_name', $request->name);
        //     if ($type == 0) {
        //         $time = $request->name . " - Hour in " . Carbon::now('Asia/Ho_Chi_Minh');
        //     } else {
        //         $time = $request->name . " - Hour out " . Carbon::now('Asia/Ho_Chi_Minh');
        //     }

        //     echo $time;
        // } else {
        //     echo "Staff " . $request->name . " successfully identified, please invite the next person";
        // }
    }
}
