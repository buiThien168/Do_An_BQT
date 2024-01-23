<?php

namespace App\Http\Services;

use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
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
    public function ListBonus($request){
        $getBonus = Discipline_reward::leftJoin('users', 'users.id', '=', 'discipline_rewards.user_id')
        ->leftJoin('user_infomations', 'user_infomations.id', '=', 'users.id')
        ->leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
        ->leftJoin('levels', 'levels.id', '=', 'user_infomations.level')
        ->select('user_infomations.full_name', 'positions.name_position', 'discipline_rewards.*')
        ->orderBy('discipline_rewards.id', 'DESC')
        ->where('discipline_rewards.type', 0)
        ->where('discipline_rewards.deleted', 0);

        if(isset($request->keyword)){
            $getBonus=$getBonus
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->where('discipline_rewards.type',0)
            ->where('discipline_rewards.deleted',0)
            ->orWhere('user_infomations.id_number',$request->keyword)
            ->where('discipline_rewards.type',0)
            ->where('discipline_rewards.deleted',0);
        }
        $getBonus=$getBonus->paginate(15);
        return $getBonus;
    }
    public function getBonus(){
        $getUsers = User::join('user_infomations','user_infomations.user_id','=','users.id')
        ->where('role',2)->get();
        return $getUsers;
    }
    public function PostAddBonus($request){
        $PostAddBonus = Discipline_reward::insert([
            'user_id'=>$request->user_id,
                'note'=>$request->note,
                'value'=>$request->value,
                'type'=>0,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
        ]);
        return $PostAddBonus;
    }
    public function DeleteBonus($id){
        $DeleteBonus = Discipline_reward::where('id',$id)->delete();
        return $DeleteBonus;
    }
    public function getIFBonus($id){
        $getBonus = Discipline_reward::where('id',$id)->first();
        return $getBonus;
    }
    public function getBonusSalary($id){
        $getBonus = Salary::where('user_id',$id)->first();
        return $getBonus;
    }
    public function PostEditBonus($id,$request){
        $PostEditBonus = Discipline_reward::where('id',$id)->update([
            'note'=>$request->note,
            'value'=>$request->value,
            'type'=>0,
            'updated_at'=>time(),
            'updater'=>Auth::user()->id,
        ]);
        return $PostEditBonus;
    }
}