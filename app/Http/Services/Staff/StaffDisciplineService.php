<?php

namespace App\Http\Services\Staff;

use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User_track;
use App\Models\Work;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class StaffDisciplineService
{
    public function ListDiscipline($request){        
        $GetDiscipline = Discipline_reward::leftJoin('users','users.id','=','discipline_rewards.user_id')
        ->leftJoin('user_infomations','user_infomations.id','=','users.id')
        ->leftJoin('positions','positions.id','=','user_infomations.positions')
        ->leftJoin('levels','levels.id','=','user_infomations.level')
        ->select('user_infomations.full_name','positions.name_position','discipline_rewards.*')
        ->orderBy('discipline_rewards.id', 'DESC')
        ->where('discipline_rewards.type',1)
        ->where('discipline_rewards.deleted',0)
        ->where('discipline_rewards.user_id',Auth::user()->id);
        if(isset($request->keyword)){
            $GetDiscipline=$GetDiscipline
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->where('discipline_rewards.type',1)
            ->where('discipline_rewards.deleted',0)
            ->where('discipline_rewards.user_id',Auth::user()->id)
            ->orWhere('user_infomations.id_number',$request->keyword)
            ->where('discipline_rewards.type',1)
            ->where('discipline_rewards.deleted',0)
            ->where('discipline_rewards.user_id',Auth::user()->id);
        }
        $GetDiscipline=$GetDiscipline->paginate(15);
        return $GetDiscipline;
    }
}