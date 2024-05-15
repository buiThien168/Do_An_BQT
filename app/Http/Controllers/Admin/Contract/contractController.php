<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ContractService;
use App\Models\educational;
use App\Models\Employee_type;
use App\Models\Position;
use App\Models\User_infomation;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
class contractController extends Controller
{
    protected $ContractService;
    public function __construct(ContractService $ContractService)
    {
        $this->ContractService = $ContractService;
    }
    public function ListContract(){
        $GetUsers = $this->ContractService->ListUserServices();
        return view('Admin.Contract.ListContract',['GetUsers'=>$GetUsers]);
    }
    public function EditContract($id){
        $getContract = $this->ContractService->EditContract($id);
        $getUser = User_infomation::with('user')->where('user_id', $id)->first();
        $employee_type = Employee_type::get();
        $positions = Position::get();
        $educational = educational::get();
        return view('Admin.Contract.AddContract',['getContract'=>$getContract,'getUser'=>$getUser,'id' => $id,'employee_type'=>$employee_type,'positions'=>$positions,'educational'=>$educational]);
    }
    public function PostContract($id, Request $request){
        $this->ContractService->PostEditContract($id, $request);
        $this->ContractService->PostEditUpdateContract($id, $request);
        return redirect('admin/contract-management');
    }
    public function printStaff($id){
        $GetUsers=$this->ContractService->getUserServices($id);
    }
    public function exportWord($id){
        $GetUsers=$this->ContractService->getUserServices($id);
        $phpWord = new PhpWord();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(base_path('public/word/hop_dong_1.docx'));
        $contract_types =0;
        if($GetUsers->contract_type==0){
            $contract_types = 'Dài hạn';
        }else{
            $contract_types = 'Ngắn hạn';
        }
        
        $templateProcessor->setValue('contract_number', $GetUsers->contract_number);
        $templateProcessor->setValue('address_A', $GetUsers->address_A);
        $templateProcessor->setValue('tax_code', $GetUsers->tax_code);
        $templateProcessor->setValue('phone_number_A', $GetUsers->phone_number_A);
        $templateProcessor->setValue('name_A', $GetUsers->name_A);
        $templateProcessor->setValue('positions', $GetUsers->name_position);
        $templateProcessor->setValue('name_B', $GetUsers->name_B);
        $templateProcessor->setValue('birth_B', date('Y-m-d',$GetUsers->birth_B));
        $templateProcessor->setValue('address_B', $GetUsers->address_B);
        $templateProcessor->setValue('CCCD_B', $GetUsers->CCCD_B);
        $templateProcessor->setValue('contract_type', $contract_types);
        $templateProcessor->setValue('start_date', date('Y-m-d',$GetUsers->start_date));
        $templateProcessor->setValue('start_end', date('Y-m-d',$GetUsers->start_end));
        $templateProcessor->setValue('position', $GetUsers->name_position);
        $templateProcessor->setValue('basic_salary', $GetUsers->basic_salary);
        $outputFile = 'hop_dong_1_'.$id.'.docx';
        $templateProcessor->saveAs(public_path($outputFile));
        return response()->download(public_path($outputFile))->deleteFileAfterSend(true);
    }
}
