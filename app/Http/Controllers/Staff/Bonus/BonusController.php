<?php

namespace App\Http\Controllers\Staff\Bonus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class BonusController extends Controller
{   
    public function ListBonus(Request $request){
        $GetBonus = DB::table('discipline_rewards')
        ->leftJoin('users','users.id','discipline_rewards.user_id')
        ->leftJoin('user_infomations','user_infomations.id','users.id')
        ->leftJoin('positions','positions.id','user_infomations.positions')
        ->leftJoin('level','level.id','user_infomations.level')
        ->select('user_infomations.full_name','positions.name_position','discipline_rewards.*')
        ->orderBy('discipline_rewards.id', 'DESC')
        ->where('discipline_rewards.type',0)
        ->where('discipline_rewards.deleted',0)
        ->where('discipline_rewards.user_id',Auth::user()->id);

        if(isset($request->keyword)){
            $GetBonus=$GetBonus
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->where('discipline_rewards.type',0)
            ->where('discipline_rewards.deleted',0)
            ->where('discipline_rewards.user_id',Auth::user()->id)
            ->orWhere('user_infomations.id_number',$request->keyword)
            ->where('discipline_rewards.type',0)
            ->where('discipline_rewards.deleted',0)
            ->where('discipline_rewards.user_id',Auth::user()->id);
        }
        $GetBonus=$GetBonus->paginate(15);

        

        return view('Staff.Bonus.ListBonus',
            [
                'GetBonus'=>$GetBonus,

            ]
        );
    }
    

    

    
    
}
