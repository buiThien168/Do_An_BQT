<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ContractService;
class contractController extends Controller
{
    protected $ContractService;
    public function __construct(ContractService $ContractService)
    {
        $this->ContractService = $ContractService;
    }
    public function ListContract(){

        $GetUsers=$this->ContractService->ListUserServices();
        return view('Admin.Contract.ListContract',['GetUsers'=>$GetUsers ]);
        //return view('Admin.Contract.AddContract');
    }
}
