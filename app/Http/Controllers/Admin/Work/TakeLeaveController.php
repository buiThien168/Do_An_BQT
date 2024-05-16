<?php
namespace App\Http\Controllers\Admin\Work;
use App\Http\Services\TakeLeaveService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TakeLeaveController extends Controller
{
    protected $TakeLeaveService;
    public function __construct(TakeLeaveService $TakeLeaveService)
    {
        $this->TakeLeaveService = $TakeLeaveService;
    }
    public function ListLeave(Request $request){
        $ListLeave =  $this->TakeLeaveService->ListLeave($request);
        return view(
            'Admin.Leave.List',
            [
                'GetListLeave' => $ListLeave,
            ]
        );
    
    }
    public function PostApproveLeave($id,Request $request){
        $this->TakeLeaveService->PostApproveLeave($id,$request);
        return back();
    }
    public function EditLeave($id){
        $EditLeave = $this->TakeLeaveService->GetLeave($id);
        return view('Admin.Leave.EditLeave',['EditLeave'=>$EditLeave,'id'=>$id]);
    }
    public function PostEditLeave($id ,Request $request){
        $PostEditLeave = $this->TakeLeaveService->PostEditLeave($id,$request);
        return redirect('admin/take-leave');
    }
    public function DeleteLeave($id,Request $request){
        $this->TakeLeaveService->DeleteLeave($id);
        return back();
    }
}
