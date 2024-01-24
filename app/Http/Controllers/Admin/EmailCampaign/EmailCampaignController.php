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
            $this->EmailService->PostAddEmailCampaign($request);
            SendEmailCampaignNow::dispatch(1);
        } else {
            $this->EmailService->PostAddEmailCampaigns($request);
            SendEmailCampaignNow::dispatch(1);
        }
        return redirect()->back()->with('msg', 'Send mail Success');
    }

    // public function ListEmailCampaign(){
    //     $getEmailCampaign = DB::table('admin_mail_campaign')
    //     ->leftJoin('admin_mail_template','admin_mail_template.id','admin_mail_campaign.mail_template_id')
    //     ->where('admin_mail_campaign.is_deleted',0)
    //     ->select('admin_mail_campaign.*','admin_mail_template.template_title')
    //     ->orderBy('admin_mail_campaign.id','desc')->paginate(20);

    //     return view('Admin.EmailCampaign.ListEmailCampaign',
    //         [
    //             'getEmailCampaign'=>$getEmailCampaign,
    //         ]
    //     );
    // }


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
            return redirect()->back()->with('msg', 'Change email information successfully');
        } catch (\Swift_TransportException $transportExp) {
            return redirect()->back()->with('msg', 'The setting information is incorrect, please check again');
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
