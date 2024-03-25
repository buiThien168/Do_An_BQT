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
            $data = Event::where('user_id', Auth::user()->id)
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get(['id', 'title', 'work', 'start', 'end', 'type']);
            return response()->json($data);
        }
        return view('Staff.Attendance.Calender');
    }
    public function handleCheckType($selectOption, $selectBreaks)
    {
        $type = 0;
        if ($selectOption === '0') {
            $type = 0;
        } else if ($selectOption === '1' && $selectBreaks === '1') {
            $type = 1;
        } else if ($selectOption === '1' && $selectBreaks === '2') {
            $type = 2;
        }

        return $type;
    }
    public function PostCalender(Request $request)
    {
        $selectOption = $request->selectOption;
        $selectBreaks = $request->selectBreaks;
        $handleCheckType = $this->handleCheckType($selectOption, $selectBreaks);
        $handleCheckTile = $this->handleCheckTile($selectOption, $request);
        $checkEvent = Event::where('user_id', Auth::user()->id)->latest()->orderBy('id', 'desc')->first();
        if ($checkEvent && (Carbon::today()->isSameDay($checkEvent->create_at) && Carbon::today()->isSameDay($request->start) && $checkEvent->type==0)) {
            switch ($request->type) {
                case 'add':
                    if($selectOption==1 && ($handleCheckType == 2 && $checkEvent->type !=2) ){
                        $event = Event::create([
                            'user_id' => Auth::user()->id,
                            'title' => $handleCheckTile,
                            'start' => $request->start,
                            'end' => $request->end,
                            'type' => $handleCheckType
                        ]);
                        return response()->json($event);
                        break;
                    }else if($selectOption==0) {
                        if ($checkEvent) {
                            $event='Cập nhật thành công';
                            $checkEvent->update([
                                'title' => $handleCheckTile,
                                'type' => $handleCheckType
                            ]);
                            return response()->json($event);
                            break;
                        } else {
                            $event='Cập nhật không thành công';
                            return response()->json($event);
                            break;
                        }   
                    }else{
                        $event='Cập nhật thất bại';
                        return response()->json($event);
                        break;
                    }
                    
                // case 'update':
                //     $event = 'ádasd';
                //     // $event = Event::find($request->id)->update([
                //     //     'title' => $request->title,
                //     //     'start' => $request->start,
                //     //     'end' => $request->end,
                //     //     'type' => $handleCheckType
                //     // ]);
                //     return response()->json($event);
                //     break;
                // case 'delete':
                    $event = Event::find($request->id)->delete();
                    return response()->json($event);
                    break;

                default:
                    break;
            }
        } else if((!Carbon::today()->isSameDay($request->start) && $selectOption==1) ) {
            if($checkEvent->created_at === $request->start){
                $event='Cập nhật thất bại';
                return response()->json($event);
            }else{
                $event = 'cập nhật thành công';
                Event::create([
                    'user_id' => Auth::user()->id,
                    'title' => $handleCheckTile,
                    'start' => $request->start,
                    'end' => $request->end,
                    'type' => $handleCheckType
                ]);
                return response()->json($event);
            }
           
        }else if(Carbon::today()->isSameDay($request->start)){
            $event = Event::create([
                'user_id' => Auth::user()->id,
                'title' => $handleCheckTile,
                'start' => $request->start,
                'end' => $request->end,
                'type' => $handleCheckType
            ]);
            return response()->json($event);
        }else{
            $event='Điểm danh thất bại';
            return response()->json($event);
        }
    }
    public function handleCheckTile($selectOption, $request)
    {
        $title = '';
        if ($selectOption === '0') {
            $title = $request->inputAttendes;
        } else if ($selectOption === '1') {
            $title = $request->inputBreaks;
        }
        return $title;
    }
    public function handleCheckTypeFace($checkType)
    {
        $type = 0;
        if ($checkType && $checkType->type === 1) {
            $type = 1;
        } else {
            $type = 0;
        }
        return $type;
    }
}
