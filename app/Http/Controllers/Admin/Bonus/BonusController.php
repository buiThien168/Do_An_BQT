<?php

namespace App\Http\Controllers\Admin\Bonus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
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
        ;

        if(isset($request->keyword)){
            $GetBonus=$GetBonus
            ->where('users.phone',$request->keyword)
            ->orWhere('user_infomations.full_name',$request->keyword)
            ->where('discipline_rewards.type',0)
            ->where('discipline_rewards.deleted',0)
            ->orWhere('user_infomations.id_number',$request->keyword)
            ->where('discipline_rewards.type',0)
            ->where('discipline_rewards.deleted',0);
        }
        $GetBonus=$GetBonus->paginate(15);

        

        return view('Admin.Bonus.ListBonus',
            [
                'GetBonus'=>$GetBonus,

            ]
        );
    }
    

    

    public function EditBonus($id){
        $getBonus = DB::table('discipline_rewards')->where('id',$id)->first();
        return view('Admin.Bonus.EditBonus',['getBonus'=>$getBonus,'id'=>$id]);
    }
    public function PostEditBonus($id,Request $request){
        $validate = $request->validate([
            'note' => 'required',
            'value' => 'required|integer',
        ]);
        $getBonus = DB::table('salary')->where('user_id',$id)->first();


        DB::table('discipline_rewards')->where('id',$id)->update(
            [   
                'note'=>$request->note,
                'value'=>$request->value,
                'type'=>0,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        
        
        return redirect('admin/bonus');
    }

    public function AddBonus(){
        $getUsers = DB::table('users')->join('user_infomations','user_infomations.user_id','users.id')
        ->where('role',2)->get();

        return view('Admin.Bonus.AddBonus',['getUsers'=>$getUsers]);
    }
    public function PostAddBonus(Request $request){
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
                'type'=>0,
                'created'=>time(),
                'created_by'=>Auth::user()->id,
            ]
        ); 
        
        return redirect('admin/bonus');
    }

    public function DeleteBonus($id){

        DB::table('discipline_rewards')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return redirect('admin/bonus');

    }
    
}
