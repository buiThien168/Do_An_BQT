<?php

namespace App\Http\Controllers\Staff\Discipline;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\StaffDisciplineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DisciplineController extends Controller
{    
    protected $StaffDisciplineService;
    public function __construct(StaffDisciplineService $StaffDisciplineService)
    {
        $this->StaffDisciplineService = $StaffDisciplineService;
    }
    public function ListDiscipline(Request $request){
       
        $GetDiscipline = $this->StaffDisciplineService->ListDiscipline($request);
        return view('Staff.Discipline.ListDiscipline',
            [
                'GetDiscipline'=>$GetDiscipline,

            ]
        );
    }
    

    

    public function EditDiscipline($id){
        $getDiscipline = DB::table('discipline_rewards')->where('id',$id)->first();
        return view('Staff.Discipline.EditDiscipline',['getDiscipline'=>$getDiscipline,'id'=>$id]);
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
        
        
        return redirect('Staff/discipline');
    }

    public function AddDiscipline(){
        $getUsers = DB::table('users')->join('user_infomations','user_infomations.user_id','users.id')
        ->where('role',2)->get();

        return view('Staff.Discipline.AddDiscipline',['getUsers'=>$getUsers]);
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
        
        return redirect('Staff/discipline');
    }

    public function DeleteDiscipline($id){

        DB::table('discipline_rewards')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('Staff/discipline');

    }
    
}
