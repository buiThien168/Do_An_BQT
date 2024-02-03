<?php

namespace App\Http\Controllers\Staff\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User_infomation;
use App\Models\User_track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class CalenderController extends Controller
{
    public function Calender(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'work', 'start', 'end','type']);
            return response()->json($data);
        }
        return view('Staff.Attendance.Calender');
    }
    public function handleCheckType($selectOption, $selectBreaks){
        $type=0;
        if($selectOption === '0' ){
            $type=0;
        }else if($selectOption === '1' && $selectBreaks === '1'){
            $type=1;
        }else if($selectOption === '1' && $selectBreaks === '2'){
            $type=2;
        }

        return $type;
    }
    public function handleCheckAttendance($checkType, $request)
    {

        $selectOption = $request->selectOption;
        $selectAttendes = $request->selectAttendes;
        $selectBreaks = $request->selectBreaks;
        $inputAttendes = $request->inputAttendes;
        $inputBreaks = $request->inputBreaks;
        
        // user_id title start end type
        if ($checkType && Carbon::today()->isSameDay($checkType->created_at)) {
            switch ($request->type) {
                case 'add':
                    $event = Event::insert([
                        'user_id' => Auth::user()->id,
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                    return response()->json($event);
                    break;
                case 'update':
                    $event = Event::find($request->id)->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                    return response()->json($event);
                    break;

                case 'delete':
                    $event = Event::find($request->id)->delete();
                    return response()->json($event);
                    break;

                default:
                    break;
            }
        } else {
            DB::beginTransaction();
            $handleCheckType = $this->handleCheckType($selectOption,$selectBreaks);
            $handleCheckTile = $this->handleCheckTile($selectOption,$request);
            try {
                if($handleCheckType===0){
                    $type=0;
                    User_track::insert([
                        'user_id' => Auth::user()->id,
                        'type' => $type,
                        'created_at' => time()
                    ]);
                }
                $event = Event::insert([
                    'user_id' => Auth::user()->id,
                    'title' => $handleCheckTile,
                    'start' => $request->start,
                    'end' => $request->end,
                    'type' => $handleCheckType
                ]);
                DB::commit();
                return response()->json($event);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Có lỗi xảy ra.'], 500);
            }
        }
    }
    public function PostCalender(Request $request)
    {
        // $getUser = User_infomation::where('full_name', $request->name)->first('user_id');
        $checkType = User_track::where('user_id', Auth::user()->id)->latest()->orderBy('id', 'desc')->first();
        $this->handleCheckAttendance($checkType, $request);
    }
    public function handleCheckTile($selectOption,$request){
        $title='';
        if($selectOption === '0'){
            $title=$request->inputAttendes;
        }else if($selectOption === '1'){
            $title=$request->inputBreaks;
        }
        return $title;
    }
    public function handleCheckTypeFace($checkType){
        $type=0;
        if($checkType && $checkType->type===1){
            $type=1;
        }else{
            $type=0;
        }
        return $type;
    }
}
