<?php

namespace App\Http\Services\Staff;

use App\Models\Bonus;
use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User_track;
use App\Models\Work;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class SatffBonusService
{
    public function ListBonus($request){        
        $getBonus = Bonus::leftJoin('users', 'users.id', '=', 'bonuses.user_id')
        ->leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
        ->leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
        ->leftJoin('levels', 'levels.id', '=', 'user_infomations.level')
        ->select('user_infomations.full_name', 'positions.name_position', 'bonuses.*')
        ->orderBy('bonuses.id', 'DESC')
        ->where('bonuses.deleted', 0)
        ->where('bonuses.user_id',Auth::user()->id);
        if(isset($request->keyword)){
            $getBonus=$getBonus
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->where('bonuses.deleted',0)
            ->where('bonuses.user_id',Auth::user()->id)
            ->orWhere('user_infomations.id_number',$request->keyword)
            ->where('bonuses.deleted',0)
            ->where('bonuses.user_id',Auth::user()->id);
        }
        $getBonus=$getBonus->paginate(15);
        return $getBonus;
    }
}