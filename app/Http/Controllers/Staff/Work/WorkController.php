<?php

namespace App\Http\Controllers\Staff\Work;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\StaffWorkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Mail;

class WorkController extends Controller
{   
    protected $StaffWorkService;
    public function __construct(StaffWorkService $StaffWorkService)
    {
        $this->StaffWorkService = $StaffWorkService;
    }
    public function FinishWork($id){
        $request = "Hoàn thành";
        try{
            DB::beginTransaction();
            $this->StaffWorkService->FinishWork($id);
            $this->StaffWorkService->PostUpdateProgress($id,$request);
            DB::commit();
            return redirect('workflow-management');
        }catch(\Exception $e){
            DB::rollBack();
        }

      
    }

    public function WorkDetail($id){
        $GetWork = $this->StaffWorkService->GetWork($id);
        $GetWorkDetail= $this->StaffWorkService->GetWorkDetail($id);
        return view('Staff.Work.WorkDetail',['GetWork'=>$GetWork,'GetWorkDetail'=>$GetWorkDetail]);
    }
    public function ListWork(Request $request){
        $GetWork =  $this->StaffWorkService->ListWork($request);
        return view('Staff.Work.ListWork',
            [
                'GetWork'=>$GetWork,
            ]
        );
    }
    

    

    public function EditWork($id){
        $GetWork = $this->StaffWorkService->GetWork($id);
        return view('Staff.Work.EditWork',['getWork'=>$GetWork,'id'=>$id]);
    }
    public function PostEditWork($id,Request $request){
        $validate = $request->validate([
            'work_name' => 'required',
            'note' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        $getWork = $this->StaffWorkService->GetWork($id);
        dd($request);
        // $request->user_id=$getWork->user_id;
        if(isset($request->email_notification)){
            $getEmailUser = DB::table('user_infomations')->where('user_id',$request->user_id)->first();

            $getEmailTemplate = DB::table('Staff_mail_template')
            ->where('id','=',2)
            ->first();
            $getEmailConfig = DB::table('Staff_mail_config')
            ->where('id','=',1)
            ->first();
            try{
                $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host,$getEmailConfig->mail_port))
                ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encryption);
                $mailer = new \Swift_Mailer($transport);
                $message = (new \Swift_Message($getEmailTemplate->template_title))
                ->setFrom($getEmailConfig->mail_username)
                ->setTo($getEmailUser->email)
                ->addPart(
                  $getEmailTemplate->template_content,
                  'text/html'
              );
                $mailer->send($message);
            }catch (\Swift_TransportException $transportExp){
            }
            $this->StaffWorkService->PostEditWork($id,$request);
            return redirect('Staff/workflow-management');
        }
    }

    public function UpdateProgress($id){
        return view('Staff.Work.UpdateProgress',['id'=>$id]);
    }
    public function PostUpdateProgress($id,Request $request){
        $validate = $request->validate([
            'work_progress' => 'required',
        ]);
        $this->StaffWorkService->PostUpdateProgress($id,$request->work_progress);
        return redirect('workflow-management/job-details/'.$id);
    }

    public function DeleteWork($id){

        DB::table('works')->where('id',$id)->update(
            [   
                'deleted'=>1,
                'updated_at'=>time(),
                'updater'=>Auth::user()->id,
            ]
        ); 
        return back();

    }
    
}
