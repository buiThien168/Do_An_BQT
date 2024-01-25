<?php

namespace App\Http\Services;

use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Discipline;
use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_infomation;
use App\Models\Work;
use App\Models\Work_progress;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class Discipline_rewardService
{
    public function ListDiscipline($request){
        $GetDiscipline = Discipline::leftJoin('users','users.id','=','disciplines.user_id')
        ->leftJoin('user_infomations','user_infomations.user_id','=','users.id')
        ->leftJoin('positions','positions.id','=','user_infomations.positions')
        ->leftJoin('levels','levels.id','=','user_infomations.level')
        ->select('user_infomations.full_name','positions.name_position','disciplines.*')
        ->orderBy('disciplines.id', 'DESC')
        ->where('disciplines.deleted',0);
        if(isset($request->keyword)){
            $GetDiscipline=$GetDiscipline
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->where('disciplines.deleted',0)
            ->orWhere('user_infomations.id_number',$request->keyword)
            ->where('disciplines.deleted',0);
        }
        $GetDiscipline=$GetDiscipline->paginate(15);
        return $GetDiscipline;
    }
    public function AddDiscipline(){
        $getUsers = User::join('user_infomations','user_infomations.user_id','users.id')->where('role',2)->get();
        return $getUsers;
    }
    public function PostAddDiscipline($request){
        $PostAddDiscipline = Discipline::insert([
            'user_id'=>$request->user_id,
            'note'=>$request->note,
            'value'=>$request->value,
            'created'=>time(),
            'created_by'=>Auth::user()->id,
        ]);
        return $PostAddDiscipline;
    }
    public function DeleteDiscipline($id){
        $DeleteDiscipline= Discipline::where('id',$id)->delete();
        return $DeleteDiscipline;
    }
    public function getDiscipline($id){
        $getDiscipline = Discipline::where('id',$id)->first();
        return $getDiscipline;
    }
    public function PostEditDiscipline($id,$request){
        $PostEditDiscipline = Discipline::where('id',$id)->update(
            [   
                'note'=>$request->note,
                'value'=>$request->value,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return $PostEditDiscipline;

    }
}