<?php

namespace App\Http\Controllers\Admin\Infomation;

use App\Http\Controllers\Controller;
use App\Http\Services\InfomationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class InfomationController extends Controller
{
    protected $InfomationService;
    public function __construct(InfomationService $InfomationService)
    {
        $this->InfomationService = $InfomationService;
    }
    public function Infomation()
    {
        $getInfo =  $this->InfomationService->Infomation();
        return view('Admin.Infomation.Index', ['getInfo' => $getInfo]);
    }
    public function PostEditInfomation(Request $request)
    {
        $validate = $request->validate([
            'phone' => 'required|digits:10',
            'email' => 'required|email',
        ]);

        $this->InfomationService->PostEditInfomation($request);
        return redirect()->back()->with('msg', 'Successful change of information');
    }
}
