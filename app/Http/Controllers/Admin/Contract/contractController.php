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

        $GetUsers=$this->ContractService->ListUserServices();
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
        return redirect('admin/contract-management');
    }
    public function exportWord($id){
        $GetUsers=$this->ContractService->EditContract($id);
        $phpWord = new PhpWord();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(base_path('public/word/hop_dong_1.docx'));
        $templateProcessor->setValue('contract_number', $GetUsers->contract_number);
        $outputFile = 'hop_dong_1_'.$id.'.docx';
        $templateProcessor->saveAs(public_path($outputFile));
        return response()->download(public_path($outputFile))->deleteFileAfterSend(true);
    }
}
