<?php

namespace App\Http\Controllers\Staff\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class contractController extends Controller
{
    public function contract(){
        $contract = Contract::where('user_id',Auth::user()->id)->first();
        return view(
            'Staff.contract.Contract',[
                'contract'=>$contract
            ]
        );
    }
}
