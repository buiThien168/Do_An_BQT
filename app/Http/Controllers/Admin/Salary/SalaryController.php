<?php

namespace App\Http\Controllers\Admin\Salary;

use App\Http\Controllers\Controller;
use App\Http\Services\SalaryService;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\User_track;
use Carbon\Carbon;
use Exception;

class SalaryController extends Controller
{

    protected $SalaryService;
    public function __construct(SalaryService $SalaryService)
    {
        $this->SalaryService = $SalaryService;
    }
    public function check($request,$times){
        if (isset($request->keyword) ) {
           
        }
    }
    public function ListSalaryStaffDetail(Request $request,$id)
    {
        if (isset($request->keyword)) {
            $keyword = $request->keyword;
            $keywordFormatted = date('Y-m', strtotime($keyword));
            $GetTime = User_track::where('user_id', $id)
                          ->whereYear('created_at', '=', date('Y', strtotime($keywordFormatted)))
                          ->whereMonth('created_at', '=', date('m', strtotime($keywordFormatted)))
                          ->get();
            //$GetTime = User_track::where('user_id', $id)->whereDate('created_at', $keyword)->get();
        }else{
            //$GetTime = User_track::where('user_id', $id)->get();
            $dateNow = date('Y-m', strtotime(now()));
            $keywordFormattedNow = date('Y-m', strtotime($dateNow));
            $GetTime = User_track::where('user_id', $id)
            ->whereYear('created_at', '=', date('Y', strtotime($keywordFormattedNow)))
            ->whereMonth('created_at', '=', date('m', strtotime($keywordFormattedNow)))
            ->get();
        }
        $GetSalary = Salary::where('user_id', $id)->first('basic_salary');
        if ($GetSalary) {
            $countTime = 0;
            $month = date('n');
            
            $totalWorkHours = 0;
            $dem=0;
            $timeIn=null;
            $checktime = array();
            for ($i = 1; $i < count($GetTime); $i++) {
                if ($GetTime[$i]->type === 1) {
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
                if(Carbon::today()->isSameDay($GetTime[$i]->created_at)){
                    $dem++;
                    $timeIn=$GetTime[$i]->created_at;

                }
            }
            if($dem==1){
                array_push($checktime, [
                    'checkin' => $timeIn,
                    'checkout' => $timeIn,
                    'time' => 0,
                    'salary' => 0,
                    'work_month' => 0
                ]);
            }
            $time = gmdate("H:i:s", $countTime);
            $salary = $countTime / 60 / 60 * $GetSalary->basic_salary;
            
            return view(
                'Admin.Salary.ListSalaryStaffDetail',
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
            return view('Admin.Salary.ListSalaryStaffDetail', [
                'checktime' => [],
                'time' => '00:00:00',
                'salary' => 0,
                'month' => date('n'),
                'totalWorkHours'=>0,
                'GetSalary' => 0
            ]);
        }
    }
    public function ListSalaryStaff()
    {
        // / 60 / 60 * $GetSalary->basic_salary;
        $getStaff = $this->SalaryService->ListSalaryStaff();
        $checktime = array();
        for ($i = 0; $i < $getStaff->total(); $i++) {
            if (isset($getStaff[$i])) {
            $GetTime = User_track::where('user_id', $getStaff[$i]->id)->get();
            if ($GetTime->isEmpty()) {
                $GetTime = [];
            }
            $GetSalary = Salary::where('user_id', $getStaff[$i]->id)->first('basic_salary');
            $total = 0;
            for ($j = 1; $j < count($GetTime); $j++) {
                if ($GetTime[$j]->type == 1) {
                    $timeDifference = $GetTime[$j]->created_at->timestamp - $GetTime[$j - 1]->created_at->timestamp;
                    $hoursDifference = $timeDifference / (60 * 60);
                    if ($hoursDifference >= 4) {
                        $total += 1;
                    } else {
                        $total += 0.5;
                    }
                }
            }
            array_push($checktime, [
                'id' => $getStaff[$i]->id,
                'salary' => $total
            ]);
        }
        }
        return view('Admin.Salary.ListSalaryStaff', ['getStaff' => $getStaff, 'checktime' => $checktime]);
    }

    public function ListSalary(Request $request)
    {
        $GetSalarys = $this->SalaryService->ListSalary($request);
        return view(
            'Admin.Salary.ListSalary',
            [
                'GetSalarys' => $GetSalarys,
            ]
        );
    }
    public function EditSalary($id)
    {
        $getSalary = $this->SalaryService->EditSalary($id);
        return view('Admin.Salary.EditSalary', ['getSalary' => $getSalary, 'id' => $id]);
    }
    public function PostEditSalary($id, Request $request)
    {
        $validate = $request->validate([
            'basic_salary' => 'required|integer',
        ]);
        $this->SalaryService->PostEditSalary($id, $request);
        return redirect('admin/salary-management');
    }
    public function Wage()
    {
        $Wage = $this->SalaryService->Wage();
        $month = date('n');
        $currentMonthDays = Carbon::now()->daysInMonth;
        return view(
            'Admin.Salary.Wage',
            [
                'Wage'=>$Wage,
                'month'=>$month,
                'currentMonthDays'=>$currentMonthDays
            ]
        );
    }
    public function send_mail($id,Request $request){
        try{
            DB::beginTransaction();
            $this->SalaryService->sendMail($id,$request);
            $this->SalaryService->PostAddEmailCampaign($id,$request);
            DB::commit();
            return redirect()->back()->with('msg', 'Gửi thư thành công');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('msg', 'Error');
        }
    }
}
