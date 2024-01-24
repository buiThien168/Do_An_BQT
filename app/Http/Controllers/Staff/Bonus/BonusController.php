<?php

namespace App\Http\Controllers\Staff\Bonus;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\SatffBonusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class BonusController extends Controller
{   
    protected $SatffBonusService;
    public function __construct(SatffBonusService $SatffBonusService)
    {
        $this->SatffBonusService = $SatffBonusService;
    }
    public function ListBonus(Request $request){
        $GetBonus = $this->SatffBonusService->ListBonus($request); 
        return view('Staff.Bonus.ListBonus',
            [
                'GetBonus'=>$GetBonus,

            ]
        );
    }
    
    

    

    
    
}
