<?php

namespace App\Http\Controllers\Staff\Salary;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\SalarysService;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\User_track;

class SalaryController extends Controller
{

    protected $SalarysService;
    public function __construct(SalarysService $SalarysService)
    {
        $this->SalarysService = $SalarysService;
    }

    public function ListSalary(Request $request)
    {
        if (isset($request->keyword)) {
            $keyword = $request->keyword;
            $keywordFormatted = date('Y-m', strtotime($keyword));
            $GetTime = User_track::where('user_id', Auth::user()->id)
                          ->whereYear('created_at', '=', date('Y', strtotime($keywordFormatted)))
                          ->whereMonth('created_at', '=', date('m', strtotime($keywordFormatted)))
                          ->get();
        }else{
            //$GetTime = User_track::where('user_id', Auth::user()->id)->get();
            $dateNow = date('Y-m', strtotime(now()));
            $keywordFormattedNow = date('Y-m', strtotime($dateNow));
            $GetTime = User_track::where('user_id', Auth::user()->id)
            ->whereYear('created_at', '=', date('Y', strtotime($keywordFormattedNow)))
            ->whereMonth('created_at', '=', date('m', strtotime($keywordFormattedNow)))
            ->get();
        }
        $GetSalary = Salary::where('user_id', Auth::user()->id)->first('basic_salary');
        if ($GetSalary) {
            $countTime = 0;
            $month = date('n');
            
            $totalWorkHours = 0;
            $checktime = array();
            for ($i = 1; $i < count($GetTime); $i++) {
                if ($GetTime[$i]->type) {
                    $timestamp1 = $GetTime[$i]->created_at->timestamp;
                    $timestamp2 = $GetTime[$i - 1]->created_at->timestamp;
                    $countTime = ($timestamp1 - $timestamp2);
                    $workTimeFormatted = gmdate("H:i:s", $countTime);
                    if ($GetTime[$i]->created_at->month == $month) {
                        $totalWorkHours += ($GetTime[$i]->work_month == 1) ? 1 : 0.5;
                    }

                    array_push($checktime, [
                        'checkin' => $GetTime[$i - 1]->created_at,
                        'checkout' => $GetTime[$i]->created_at,
                        'time' => $workTimeFormatted,
                        'salary' => 0,
                        'work_month' => $GetTime[$i]->work_month
                    ]);
                }
            }
            $time = gmdate("H:i:s", $countTime);
            $salary = $countTime / 60 / 60 * $GetSalary->basic_salary;
            
            return view(
                'Staff.Salary.ListSalary',
                [
                    'checktime' => $checktime,
                    'time' => $time,
                    'salary' => $salary,
                    'mounth' => $month,
                    'GetSalary' => $GetSalary->basic_salary,
                    'totalWorkHours'=>$totalWorkHours,
                    'month'=>$month
                ]
            );
        } else {
            return view('Staff.Salary.ListSalary', [
                'checktime' => [],
                'time' => '00:00:00',
                'salary' => 0,
                'month' => date('n'),
                'totalWorkHours'=>0,
                'GetSalary' => 0
            ]);
        }
    }
}
