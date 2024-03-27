<?php

namespace App\Http\Services;

use App\Models\Event;

class TakeLeaveService
{
    public function ListLeave()
    {
        $ListLeave =  Event::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'events.user_id')
        ->where('events.type', '!=', '0')
        ->select('user_infomations.full_name', 'events.*')
        ->orderBy('events.id', 'DESC')->paginate(10);
        return $ListLeave;
    }
    public function PostApproveLeave($id,$request){
        $PostApproveLeave= Event::where('id',$id)->update([
            'check_event'=>1
        ]);
        return $PostApproveLeave;
    }
    public function GetLeave($id){
        $recordToUpdate = Event::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'events.user_id')
        ->where('events.type', '!=', '0')
        ->where('events.id', '=', $id)
        ->select('user_infomations.full_name', 'events.*')
        ->orderBy('events.id', 'DESC')
        ->first();
        return $recordToUpdate;
    }
    public function PostEditLeave($id,$request){
        Event::where('id', $id)->update([
            'work' => null,
            'title'=>$request->inputAttendes,
            'type'=>$request->selectBreaks,
            'check_event'=>$request->check_event,
        ]);
    }
    public function DeleteLeave($id){
        $DeleteLeave = Event::where('id',$id)->delete();
        return $DeleteLeave;
    }
}
