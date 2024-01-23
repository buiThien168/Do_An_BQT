<?php

namespace App\Http\Controllers\Admin\Bonus;

use App\Http\Controllers\Controller;
use App\Http\Services\BonusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Models\User;

class BonusController extends Controller
{
    protected $BonusService;
    public function __construct(BonusService $BonusService)
    {
        $this->BonusService = $BonusService;
    }
    public function ListBonus(Request $request)
    {
        $GetBonus =  $this->BonusService->ListBonus($request);
        return view(
            'Admin.Bonus.ListBonus',
            [
                'GetBonus' => $GetBonus,

            ]
        );
    }
    public function EditBonus($id)
    {
        $getBonus = $this->BonusService->getIFBonus($id);
        return view('Admin.Bonus.EditBonus', ['getBonus' => $getBonus, 'id' => $id]);
    }
    public function PostEditBonus($id, Request $request)
    {
        $validate = $request->validate([
            'note' => 'required',
            'value' => 'required|integer',
        ]);
        $getBonus = $this->BonusService->getBonusSalary($id);
        $this->BonusService->PostEditBonus($id, $request);
        return redirect('admin/bonus');
    }

    public function AddBonus()
    {
        $getUsers = $this->BonusService->getBonus();
        return view('Admin.Bonus.AddBonus', ['getUsers' => $getUsers]);
    }
    public function PostAddBonus(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|integer',
            'note' => 'required',
            'value' => 'required|integer',
        ]);

        $this->BonusService->PostAddBonus($request);
        return redirect('admin/bonus');
    }

    public function DeleteBonus($id)
    {
        $this->BonusService->DeleteBonus($id);
        return redirect('admin/bonus');
    }
}
