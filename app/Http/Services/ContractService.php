<?php

namespace App\Http\Services;

use App\Models\Contract;
use App\Models\Level;
use App\Models\User;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;

class ContractService
{
    public function getUsersListLevel()
    {
        $getUsers = User_infomation::where('level', '!=', null)->get('level');
        return $getUsers;
    }
    public function ListUserServices()
    {
        $GetUsers = User::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->select('user_infomations.full_name', 'users.*', 'user_infomations.image', 'user_infomations.email','user_infomations.contracts')
            ->where('users.is_deleted', 0)
            ->where('users.role', 2)
            ->orderBy('users.id', 'DESC')
            ->paginate(10);
        return $GetUsers;
    }
    public function EditContract($id)
    {
        $getSalary = Contract::where('user_id', $id)->first();
        return $getSalary;
    }
    public function PostEditContract($id, $request)
    {
        $getContract = $this->EditContract($id);
        if ($getContract == null) {
            Contract::create([
                'name_contract'=>$request->name_contract,
                'user_id' =>$id,
                'contract_type' =>$request->contract_type,
                'contract_number' =>$request->contract_number,
                'signing_date' =>date(strtotime($request->signing_date)),
                'start_date' =>date(strtotime($request->start_date)),
                'start_end' =>date(strtotime($request->start_end)),
                'name_A' =>$request->name_A,
                'birth_A' =>date(strtotime($request->birth_A)),
                'phone_number_A' =>$request->phone_number_A,
                'email_A'=>$request->email_A,
                'name_B'=>$request->name_B,
                'birth_B'=>date(strtotime($request->birth_B)),
                'phone_number_B'=>$request->phone_number_B,
                'email_B'=>$request->email_B,
                'positions'=>$request->position,
                'basic_salary'=>$request->basic_salary,
                'employee_type'=>$request->employee_type,
                'educationals'=>$request->educationals,
                'note'=>$request->note,
            ]);
        } else {
            Contract::where('user_id', $id)->update([
                'name_contract'=>$request->name_contract,
                'user_id' =>$id,
                'contract_type' =>$request->contract_type,
                'contract_number' =>$request->contract_number,
                'signing_date' =>date(strtotime($request->signing_date)),
                'start_date' =>date(strtotime($request->start_date)),
                'start_end' =>date(strtotime($request->start_end)),
                'name_A' =>$request->name_A,
                'birth_A' =>date(strtotime($request->birth_A)),
                'phone_number_A' =>$request->phone_number_A,
                'email_A'=>$request->email_A,
                'name_B'=>$request->name_B,
                'birth_B'=>date(strtotime($request->birth_B)),
                'phone_number_B'=>$request->phone_number_B,
                'email_B'=>$request->email_B,
                'positions'=>$request->position,
                'basic_salary'=>$request->basic_salary,
                'employee_type'=>$request->employee_type,
                'educationals'=>$request->educationals,
                'note'=>$request->note,
            ]);
        }
    }
}
