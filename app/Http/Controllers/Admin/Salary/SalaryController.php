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

class SalaryController extends Controller
{

    protected $SalaryService;
    public function __construct(SalaryService $SalaryService)
    {
        $this->SalaryService = $SalaryService;
    }
    public function ListSalaryStaffDetail($id)
    {
        $GetTime = User_track::where('user_id', $id)->get();
        $GetSalary = Salary::where('user_id', $id)->first('hourly_salary');
        if ($GetSalary) {
            $countTime = 0;
            $checktime = array();
            for ($i = 1; $i < count($GetTime); $i++) {
                if ($GetTime[$i]->type == 1) {
                    $countTime += $GetTime[$i]->created_at->timestamp - $GetTime[$i - 1]->created_at->timestamp;
                    array_push($checktime, [
                        'checkin' => $GetTime[$i - 1]->created_at,
                        'checkout' => $GetTime[$i]->created_at,
                        'time' => gmdate("H:i:s", $GetTime[$i]->created_at->timestamp - $GetTime[$i - 1]->created_at->timestamp),
                        'salary' => ($GetTime[$i]->created_at->timestamp - $GetTime[$i - 1]->created_at->timestamp) / 60 / 60 * $GetSalary->hourly_salary
                    ]);
                }
            }
            $time = gmdate("H:i:s", $countTime);
            $salary = $countTime / 60 / 60 * $GetSalary->hourly_salary;
            $mounth = date('n');
            return view(
                'Admin.Salary.ListSalaryStaffDetail',
                [
                    'checktime' => $checktime,
                    'time' => $time,
                    'salary' => $salary,
                    'mounth' => $mounth,
                    'GetSalary' => $GetSalary->hourly_salary
                ]
            );
        } else {
            return view('Admin.Salary.ListSalaryStaffDetail', [
                'checktime' => [],
                'time' => '00:00:00',
                'salary' => 0,
                'month' => date('n'),
                'GetSalary' => 0
            ]);
        }
    }

    public function ListSalaryStaff()
    {
        $getStaff = $this->SalaryService->ListSalaryStaff();
        $checktime = array();
        for ($i = 0; $i < $getStaff->total(); $i++) {
            $GetTime = User_track::where('user_id', $getStaff[$i]->id)->get();
            $GetSalary = Salary::where('user_id', $getStaff[$i]->id)->first('hourly_salary');
            $total = 0;
            for ($j = 1; $j < count($GetTime); $j++) {
                if ($GetTime[$j]->type == 1) {
                    $total += ($GetTime[$j]->created_at->timestamp  - $GetTime[$j - 1]->created_at->timestamp) / 60 / 60 * $GetSalary->hourly_salary;
                }
            }
            array_push($checktime, [
                'id' => $getStaff[$i]->id,
                'salary' => $total
            ]);
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
            'hourly_salary' => 'required|integer',
        ]);
        $this->SalaryService->PostEditSalary($id, $request);
        return redirect('admin/salary-management');
    }
    public function Wage()
    {
        $Wage = $this->SalaryService->Wage();
        return view(
            'Admin.Salary.Wage',
            [
                'Wage'=>$Wage,
            ]
        );
    }
}
