<?php

namespace App\Http\Services;

use App\Models\Position;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalaryService
{
    public function ListSalary($request)
    {
        $GetSalarys = User::leftJoin('salary', 'users.id', '=', 'salary.user_id')
            ->leftJoin('user_infomations', 'users.id', '=', 'user_infomations.id')
            ->leftJoin('positions', 'user_infomations.positions', '=', 'positions.id')
            ->leftJoin('levels', 'user_infomations.level', '=', 'levels.id')
            ->select(
                'user_infomations.full_name',
                'users.id',
                'positions.name_position',
                'salary.hourly_salary',
                'salary.created',
                'levels.qualification_name'
            )
            ->orderBy('users.id', 'DESC')
            ->where('user_infomations.full_name', '!=', null);
        if (isset($request->keyword)) {
            $GetSalarys = $GetSalarys
                ->where('users.phone', $request->keyword)
                ->orWhere('user_infomations.full_name', $request->keyword)
                ->orWhere('user_infomations.id_number', $request->keyword);
        }
        $GetSalarys = $GetSalarys->paginate(15);
        return $GetSalarys;
    }
    public function EditSalary($id)
    {
        $getSalary = Salary::where('user_id', $id)->first();
        return $getSalary;
    }
    public function PostEditSalary($id, $request)
    {
        $getSalary = $this->EditSalary($id);
        if ($getSalary == null) {
            Salary::insert([
                'user_id' => $id,
                'hourly_salary' => $request->hourly_salary,
                'created' => time(),
                'created_by' => Auth::user()->id,
                'updated_at' => null,
                'updater' => null,
            ]);
        } else {
            Salary::where('user_id', $id)->update([
                'user_id' => $id,
                'hourly_salary' => $request->hourly_salary,
                'updated_at' => time(),
                'updater' => Auth::user()->id,
            ]);
        }
    }
    public function ListSalaryStaff()
    {
        $getStaff = User::leftJoin('user_infomations', 'users.id', '=', 'user_infomations.user_id')
            ->leftJoin('salary', 'users.id', '=', 'salary.user_id')
            ->leftJoin('positions', 'user_infomations.positions', '=', 'positions.id')
            ->select('users.id', 'user_infomations.full_name', 'salary.hourly_salary', 'positions.name_position')
            ->where('users.role', 2)
            ->orderBy('users.id', 'desc')
            ->paginate(15);
        return  $getStaff;
    }
    public function Wage()
    {
        $getStaff = User::leftJoin('user_infomations', 'users.id', '=', 'user_infomations.user_id')
            ->leftJoin('salary', 'users.id', '=', 'salary.user_id')
            ->leftJoin('positions', 'user_infomations.positions', '=', 'positions.id')
            ->leftJoin(
                DB::raw('(SELECT user_id, SUM(value) as total_bonuses FROM bonuses GROUP BY user_id) as bonuses'),
                'users.id',
                '=',
                'bonuses.user_id'
            )
            ->leftJoin(
                DB::raw('(SELECT user_id, SUM(value) as total_disciplines FROM disciplines GROUP BY user_id) as disciplines'),
                'users.id',
                '=',
                'disciplines.user_id'
            )
            ->select(
                'users.id',
                'user_infomations.full_name',
                'salary.hourly_salary',
                'positions.name_position',
                DB::raw('IFNULL(bonuses.total_bonuses, 0) as total_bonuses'),
                DB::raw('IFNULL(disciplines.total_disciplines, 0) as total_disciplines')
            )
            ->where('users.role', 2)
            ->orderBy('users.id', 'desc')
            ->paginate(15);

        return $getStaff;
    }
}
