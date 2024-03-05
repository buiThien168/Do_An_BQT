<?php

namespace App\Http\Controllers\Admin\Work;

use App\Http\Controllers\Controller;
use App\Http\Services\WorkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Mail;

class WorkController extends Controller
{   
    protected $WorkService;
    public function __construct(WorkService $WorkService)
    {
        $this->WorkService = $WorkService;
    }
    public function WorkDetail($id){
         $GetWork = $this->WorkService->getWork($id);
         $GetWorkDetail= $this->WorkService->getWorkProgress($id);
        return view('Admin.Work.WorkDetail',['GetWork'=>$GetWork,'GetWorkDetail'=>$GetWorkDetail]);
    }
    public function ListWork(Request $request){
        $GetWork = $this->WorkService->ListWork($request);
        return view('Admin.Work.ListWork',
            [
                'GetWork'=>$GetWork,
            ]
        );
    }

    public function EditWork($id){
        $getWork = $this->WorkService->EditWork($id);
        return view('Admin.Work.EditWork',['getWork'=>$getWork,'id'=>$id]);
    }
    public function PostEditWork($id,Request $request){
        $validate = $request->validate([
            'work_name' => 'required',
            'note' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        $getWork = $this->WorkService->getWork($id);
        // $request->user_id=$getWork->user_id;
        if(isset($request->email_notification)){
            $this->WorkService->sendMailWorks($getWork->user_id,$request);
            $this->WorkService->PostEditWork($id,$request);
            return redirect('admin/workflow-management');
        }else{
            $this->WorkService->PostEditWork($id,$request);
            return redirect('admin/workflow-management');
        }
    }

    public function AddWork(){
       $getUsers = $this->WorkService->AddWork();
        return view('Admin.Work.AddWork',['getUsers'=>$getUsers]);
    }
    public function PostAddWork(Request $request){
        $validate = $request->validate([
            'user_id' => 'required|integer',
            'work_name' => 'required',
            'note' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        if (isset($request->email_notification)) {
            $this->WorkService->SendMail($request);
            $this->WorkService->PostAddWorks($request);
            return redirect('admin/workflow-management');
        }else{
            $this->WorkService->PostAddWorks($request);
            return redirect('admin/workflow-management');
        }        
    }

    public function DeleteWork($id){
        $this->WorkService->DeleteWork($id);
        return back();
    }
    
}
