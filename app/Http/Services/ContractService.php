<?php

namespace App\Http\Services;

use App\Models\Level;
use App\Models\User;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class ContractService
{
    public function getUsersListLevel()
    {
        $getUsers = User_infomation::where('level', '!=', null)->get('level');
        return $getUsers;
    }
    public function ListUserServices()
    {
        $GetUsers = User::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->select('user_infomations.full_name', 'users.*', 'user_infomations.image', 'user_infomations.email')
            ->where('users.is_deleted', 0)
            ->where('users.role', 2)
            ->orderBy('users.id', 'DESC')
            ->paginate(10);
        return $GetUsers;
    }
}
