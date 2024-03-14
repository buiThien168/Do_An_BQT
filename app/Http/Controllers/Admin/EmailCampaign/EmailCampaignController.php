<?php

namespace App\Http\Controllers\Admin\EmailCampaign;

use App\Http\Controllers\Controller;
use App\Http\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\shop;
use App\Models\products;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendEmailCampaignNow;
use Exception;
use Illuminate\Support\Facades\DB;

class EmailCampaignController extends Controller
{
    protected $EmailService;
    public function __construct(EmailService $EmailService)
    {
        $this->EmailService = $EmailService;
    }
    public function AddEmailCampaign()
    {
        $listUser = $this->EmailService->GetUserIF();
        $template = $this->EmailService->AddEmailCampaign();
        return view('Admin.EmailCampaign.AddEmailCampaign', ['listUser' => $listUser, 'template' => $template]);
    }
    public function PostAddEmailCampaign(Request $request)
    {
        if (isset($request->send_email_all)) {
            try{
                DB::beginTransaction();
                $this->EmailService->PostAddEmailCampaignAllUser($request);
                $this->EmailService->sendMail($request);
                DB::commit();
                return redirect()->back()->with('msg', 'Gửi thư thành công');
            }catch(Exception $e){
                DB::rollBack();
                return redirect()->back()->with('msg', 'Error');
            }
          
        } else {
            try{
                DB::beginTransaction();
                $this->EmailService->sendMail($request);
                $this->EmailService->PostAddEmailCampaign($request);
                DB::commit();
                return redirect()->back()->with('msg', 'Gửi thư thành công');
            }catch(Exception $e){
                DB::rollBack();
                return redirect()->back()->with('msg', 'Error');
            }
        }
       
    }

    public function PostEditEmailConfig(Request $request)
    {
        try {
            $transport = (new \Swift_SmtpTransport($request->mail_host, $request->mail_port))
                ->setUsername($request->mail_username)->setPassword($request->mail_password)->setEncryption('tls');
            $mailer = new \Swift_Mailer($transport);
            $message = (new \Swift_Message('Test mail'))
                ->setFrom([$request->mail_username => 'Account Test'])
                ->setTo([$request->mail_username, $request->mail_username => 'Name test'])
                ->setBody('Test email');
            $result = $mailer->send($message);

            $this->EmailService->PostEditEmailConfig($request);
            return redirect()->back()->with('msg', 'Thay đổi thông tin email thành công');
        } catch (\Swift_TransportException $transportExp) {
            return redirect()->back()->with('msg', 'Thông tin cài đặt không chính xác, vui lòng kiểm tra lại');
        }
    }
    public function EmailConfig()
    {
        $getEmailConfig = $this->EmailService->EmailConfig();
        return view(
            'Admin.EmailCampaign.EmailConfig',
            [
                'getEmailConfig' => $getEmailConfig,
            ]
        );
    }


    public function ListEmailTemplate()
    {
        $getEmailTemplate = $this->EmailService->ListEmailTemplate() ?? [];
        return view(
            'Admin.EmailCampaign.ListEmailTemplate',
            [
                'getEmailTemplate' => $getEmailTemplate,
            ]
        );
    }

    public function DeleteEmailTemplate($id)
    {
        $this->EmailService->DeleteEmailTemplate($id);
        return redirect()->back();
    }

    public function EditEmailTemplate($id)
    {
        $getEmailTemplate = $this->EmailService->EditEmailTemplate($id);
        return view(
            'Admin.EmailCampaign.EditEmailTemplate',
            [
                'getEmailTemplate' => $getEmailTemplate,
            ]
        );
    }

    public function PostEditEmailTemplate($id, Request $request)
    {
        $this->EmailService->PostEditEmailTemplate($id, $request);
        return redirect('/admin/email-marketing/email-template');
    }

    public function AddEmailTemplate()
    {
        return view('Admin.EmailCampaign.AddEmailTemplate');
    }
    public function PostAddEmailTemplate(Request $request)
    {
        $this->EmailService->PostAddEmailTemplate($request);
        return redirect('/admin/email-marketing/email-template');
    }
}
