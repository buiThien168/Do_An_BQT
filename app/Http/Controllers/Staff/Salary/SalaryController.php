<?php

namespace App\Http\Controllers\Staff\Salary;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\SalarysService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SalaryController extends Controller
{

    protected $SalarysService;
    public function __construct(SalarysService $SalarysService)
    {
        $this->SalarysService = $SalarysService;
    }

    public function ListSalary(Request $request)
    {
        $GetTime = $this->SalarysService->GetTime();
        $GetSalary = $this->SalarysService->GetSalary();
        if ($GetSalary) {
            $countTime = 0;
            $checktime = array();
            for ($i = 1; $i < count($GetTime); $i++) {
                if ($GetTime[$i]->type == 1) {
                    $countTime += $GetTime[$i]->created_at->timestamp - $GetTime[$i - 1]->created_at->timestamp;
                    array_push($checktime, [
                        'checkin' => $GetTime[$i - 1]->created_at->timestamp,
                        'checkout' => $GetTime[$i]->created_at->timestamp,
                        'time' => gmdate("H:i:s", $GetTime[$i]->created_at->timestamp - $GetTime[$i - 1]->created_at->timestamp),
                        'salary' => ($GetTime[$i]->created_at->timestamp - $GetTime[$i - 1]->created_at->timestamp) / 60 / 60 * $GetSalary->basic_salary
                    ]);
                }
            }

            if ($GetSalary == null) {
                $salary = 0;
            } else {
                $salary = $countTime / 60 / 60 * $GetSalary->basic_salary;
            }
            $time = gmdate("H:i:s", $countTime);
            $mounth = date('n');
            return view(
                'Staff.Salary.ListSalary',
                [
                    'checktime' => $checktime,
                    'time' => $time,
                    'salary' => $salary,
                    'mounth' => $mounth,
                    'GetSalary' => $GetSalary->basic_salary
                ]
            );
        } else {
            return view(
                'Staff.Salary.ListSalary',
                [
                    'checktime' => [],
                    'time' => '00:00:00',
                    'salary' => 0,
                    'month' => date('n'),
                    'GetSalary' => 0
                ]
            );
        }
    }
}
