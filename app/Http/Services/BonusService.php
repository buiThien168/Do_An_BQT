<?php

namespace App\Http\Services;

use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Bonus;
use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_infomation;
use App\Models\Work;
use App\Models\Work_progress;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class BonusService
{
    public function ListBonus($request)
    {
        $getBonus = Bonus::leftJoin('users', 'bonuses.user_id', '=', 'users.id')
            ->leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
            ->leftJoin('levels', 'levels.id', '=', 'user_infomations.level')
            ->select('user_infomations.full_name', 'positions.name_position', 'bonuses.*')
            ->orderBy('bonuses.id', 'DESC')
            ->where('bonuses.deleted', 0);
        if (isset($request->keyword)) {
            $getBonus = $getBonus->where(function ($query) use ($request) {
                $query->where('users.phone', $request->keyword)
                    ->orWhere('user_infomations.nick_name','like','%'.$request->keyword.'%')
                    ->orWhere('user_infomations.id_number', $request->keyword);
            });
        }

        $getBonus = $getBonus->paginate(15);
        return $getBonus;
    }
    public function getBonus()
    {
        $getUsers = User::join('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->where('role', 2)->get();
        return $getUsers;
    }
    public function PostAddBonus($request)
    {
        $PostAddBonus = Bonus::create([
            'user_id' => $request->user_id,
            'note' => $request->note,
            'value' => $request->value,
            'created' => time(),
            'created_by' => Auth::user()->id,
        ]);
        return $PostAddBonus;
    }
    public function DeleteBonus($id)
    {
        $DeleteBonus = Bonus::where('id', $id)->delete();
        return $DeleteBonus;
    }
    public function getIFBonus($id)
    {
        $getBonus = Bonus::where('id', $id)->first();
        return $getBonus;
    }
    public function getBonusSalary($id)
    {
        $getBonus = Salary::where('user_id', $id)->first();
        return $getBonus;
    }
    public function PostEditBonus($id, $request)
    {
        $PostEditBonus = Bonus::where('id', $id)->update([
            'note' => $request->note,
            'value' => $request->value,
            'updater' => Auth::user()->id,
        ]);
        return $PostEditBonus;
    }
}
