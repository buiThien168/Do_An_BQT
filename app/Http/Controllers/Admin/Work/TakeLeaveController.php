<?php
namespace App\Http\Controllers\Admin\Work;
use App\Http\Services\TakeLeaveService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TakeLeaveController extends Controller
{
    protected $TakeLeaveService;
    public function __construct(TakeLeaveService $TakeLeaveService)
    {
        $this->TakeLeaveService = $TakeLeaveService;
    }
    public function ListLeave(){
        $ListLeave =  $this->TakeLeaveService->ListLeave();
        dd($ListLeave);
        // return view('Staff.Work.ListWork',
        //     [
        //         'GetWork'=>$GetWork,
        //     ]
        // );
    
    }
}
