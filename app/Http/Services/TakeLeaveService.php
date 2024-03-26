<?php

namespace App\Http\Services;

use App\Models\Event;

class TakeLeaveService
{
    public function ListLeave()
    {
        $ListLeave =  Event::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'events.user_id')
        ->select('user_infomations.full_name', 'events.*')
        ->orderBy('events.id', 'DESC')->get();
        return $ListLeave;
    }
}
