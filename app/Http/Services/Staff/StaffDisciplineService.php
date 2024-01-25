<?php

namespace App\Http\Services\Staff;

use App\Models\Discipline;
use Illuminate\Support\Facades\Auth;

class StaffDisciplineService
{
    public function ListDiscipline($request)
    {
        $GetDiscipline = Discipline::leftJoin('users', 'users.id', '=', 'disciplines.user_id')
            ->leftJoin('user_infomations', 'user_infomations.id', '=', 'users.id')
            ->leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
            ->leftJoin('levels', 'levels.id', '=', 'user_infomations.level')
            ->select('user_infomations.full_name', 'positions.name_position', 'disciplines.*')
            ->orderBy('disciplines.id', 'DESC')
            ->where('disciplines.deleted', 0)
            ->where('disciplines.user_id', Auth::user()->id);
        if (isset($request->keyword)) {
            $GetDiscipline = $GetDiscipline
                ->where('users.phone', $request->keyword)
                ->orWhere('user_infomations.full_name', $request->keyword)
                ->where('disciplines.deleted', 0)
                ->where('disciplines.user_id', Auth::user()->id)
                ->orWhere('user_infomations.id_number', $request->keyword)
                ->where('disciplines.deleted', 0)
                ->where('disciplines.user_id', Auth::user()->id);
        }
        $GetDiscipline = $GetDiscipline->paginate(15);
        return $GetDiscipline;
    }
}
