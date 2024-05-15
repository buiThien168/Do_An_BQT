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
            ->leftJoin('contracts', 'contracts.user_id', '=', 'user_infomations.user_id')
            ->select('user_infomations.full_name', 'users.*', 'user_infomations.image', 'user_infomations.email','user_infomations.contracts','contracts.start_date','contracts.start_end')
            ->where('users.is_deleted', 0)
            ->where('users.role', 2)
            ->orderBy('users.id', 'DESC')
            ->paginate(10);
        return $GetUsers;
        // $GetUsers = User::leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
        //     ->select('user_infomations.full_name', 'users.*', 'user_infomations.image', 'user_infomations.email','user_infomations.contracts')
        //     ->where('users.is_deleted', 0)
        //     ->where('users.role', 2)
        //     ->orderBy('users.id', 'DESC')
        //     ->paginate(10);
        // return $GetUsers;
    }
    
    public function EditContract($id)
    {
        $getSalary = Contract::where('user_id', $id)->first();
        return $getSalary;
    }
    public function getUserServices($id)
    {
        $getUser = Contract::leftJoin('positions','positions.id','contracts.positions')
        ->select('positions.name_position', 'contracts.*',)
        ->where('contracts.user_id', $id)
        ->first();
        return $getUser;
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
                'tax_code' =>$request->tax_code,
                'phone_number_A' =>$request->phone_number_A,
                'address_A'=>$request->address_A,
                'name_B'=>$request->name_B,
                'birth_B'=>date(strtotime($request->birth_B)),
                'phone_number_B'=>$request->phone_number_B,
                'address_B'=>$request->address_B,
                'CCCD_B'=>$request->CCCD_B,
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
                'tax_code' =>$request->tax_code,
                'phone_number_A' =>$request->phone_number_A,
                'address_A'=>$request->address_A,
                'name_B'=>$request->name_B,
                'birth_B'=>date(strtotime($request->birth_B)),
                'phone_number_B'=>$request->phone_number_B,
                'address_B'=>$request->address_B,
                'CCCD_B'=>$request->CCCD_B,
                'positions'=>$request->position,
                'basic_salary'=>$request->basic_salary,
                'employee_type'=>$request->employee_type,
                'educationals'=>$request->educationals,
                'note'=>$request->note,
            ]);
        }
    }
    public function getPrintStaff($id){

    }
    public function PostEditUpdateContract($id, $request)
    {
        $start_date = strtotime($request->start_date);
        $end_date = strtotime($request->start_end);
        if ($start_date != null && $end_date != null) {
            $current_time = time();
            $time_left = $end_date - $current_time;
            if ($time_left <= 604800) {
                User_infomation::where('user_id', $id)->update([
                    'contracts' => 2,
                ]);
            }else{
                User_infomation::where('user_id', $id)->update([
                    'contracts' => 1,
                ]);
            }
        }
    }
}
