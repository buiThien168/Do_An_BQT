<?php

namespace App\Http\Controllers\Admin\Discipline;

use App\Http\Controllers\Controller;
use App\Http\Services\Discipline_rewardService;
use App\Models\Discipline_reward;
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
        $GetDiscipline=  $this->Discipline_rewardService->ListDiscipline($request);
        return view('Admin.Discipline.ListDiscipline',
            [
                'GetDiscipline'=>$GetDiscipline,

            ]
        );
    }
    
    public function EditDiscipline($id){
        $getDiscipline = DB::table('discipline_rewards')->where('id',$id)->first();
        return view('Admin.Discipline.EditDiscipline',['getDiscipline'=>$getDiscipline,'id'=>$id]);
    }
    public function PostEditDiscipline($id,Request $request){
        $validate = $request->validate([
            'note' => 'required',
            'value' => 'required|integer',
        ]);
        $getDiscipline = DB::table('salary')->where('user_id',$id)->first();


        DB::table('discipline_rewards')->where('id',$id)->update(
            [   
                'note'=>$request->note,
                'value'=>$request->value,
                'type'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        
        
        return redirect('admin/discipline');
    }

    public function AddDiscipline(){
        $getUsers = DB::table('users')->join('user_infomations','user_infomations.user_id','users.id')
        ->where('role',2)->get();

        return view('Admin.Discipline.AddDiscipline',['getUsers'=>$getUsers]);
    }
    public function PostAddDiscipline(Request $request){
        $validate = $request->validate([
            'user_id' => 'required|integer',
            'note' => 'required',
            'value' => 'required|integer',
        ]);
        
        DB::table('discipline_rewards')->insert(
            [   
                'user_id'=>$request->user_id,
                'note'=>$request->note,
                'value'=>$request->value,
                'type'=>1,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        
        return redirect('admin/discipline');
    }

    public function DeleteDiscipline($id){

        DB::table('discipline_rewards')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/discipline');

    }
    
}
