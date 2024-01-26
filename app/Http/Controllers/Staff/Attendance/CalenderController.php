<?php

namespace App\Http\Controllers\Staff\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User_infomation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalenderController extends Controller
{
    public function Calender(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end','<=', $request->end)
                ->get(['id', 'title','work', 'start', 'end']);
            return response()->json($data);  
        }
        return view('Staff.Attendance.Calender');
    }
    public function PostCalender(Request $request)
    {
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
    }
}
