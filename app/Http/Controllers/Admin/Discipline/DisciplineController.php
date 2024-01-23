<?php

namespace App\Http\Controllers\Admin\Discipline;

use App\Http\Controllers\Controller;
use App\Http\Services\Discipline_rewardService;
use App\Models\Discipline_reward;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DisciplineController extends Controller
{   
    protected $Discipline_rewardService;
    public function __construct(Discipline_rewardService $Discipline_rewardService)
    {
        $this->Discipline_rewardService = $Discipline_rewardService;
    }
    public function ListDiscipline(Request $request){
        $GetDiscipline= $this->Discipline_rewardService->ListDiscipline($request);
        return view('Admin.Discipline.ListDiscipline',
            [
                'GetDiscipline'=>$GetDiscipline,

            ]
        );
    }
    
    public function EditDiscipline($id){
        $getDiscipline = $this->Discipline_rewardService->getDiscipline($id);
        return view('Admin.Discipline.EditDiscipline',['getDiscipline'=>$getDiscipline,'id'=>$id]);
    }
    public function PostEditDiscipline($id,Request $request){
        $validate = $request->validate([
            'note' => 'required',
            'value' => 'required|integer',
        ]);
        $getDiscipline = Salary::where('user_id',$id)->first();
        $this->Discipline_rewardService->PostEditDiscipline($id,$request);
        return redirect('admin/discipline');
    }

    public function AddDiscipline(){
        $getUsers = $this->Discipline_rewardService->AddDiscipline();
        return view('Admin.Discipline.AddDiscipline',['getUsers'=>$getUsers]);
    }

    public function PostAddDiscipline(Request $request){
        $validate = $request->validate([
            'user_id' => 'required|integer',
            'note' => 'required',
            'value' => 'required|integer',
        ]);     
        $this->Discipline_rewardService->PostAddDiscipline($request);
        return redirect('admin/discipline');
    }

    public function DeleteDiscipline($id){
        $this->Discipline_rewardService->DeleteDiscipline($id);
        return redirect('admin/discipline');
    }
    
}
