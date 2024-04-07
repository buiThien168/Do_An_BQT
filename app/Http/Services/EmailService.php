<?php

namespace App\Http\Services;

use App\Models\Admin_mail_campaign_detail;
use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Discipline_reward;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_face;
use App\Models\User_infomation;
use App\Models\Work;
use App\Models\Work_progress;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class EmailService
{
    public function ListEmailTemplate()
    {
        $getEmailTemplate = Admin_mail_template::where('admin_mail_templates.is_deleted', 0)->orderBy('admin_mail_templates.id', 'desc')->paginate(20);
        return $getEmailTemplate;
    }
    public function PostAddEmailTemplate($request)
    {
        $PostAddEmailTemplate = Admin_mail_template::create([
            'template_title' => $request->template_title,
            'template_content' => $request->template_content,
            'updated_by' => Auth::user()->id
        ]);
        return $PostAddEmailTemplate;
    }
    public function PostAddEmailCampaigns($request)
    {
        for ($i = 1; $i <= count($request->list_users); $i++) {
            $getIdUserMail = User_infomation::where('user_id', '=', $request->list_users[$i - 1])->first();
            $insertMailSend = Admin_mail_campaign_detail::insert(
                [
                    'admin_template_id' => $request->admin_template_id,
                    'admin_mail_config_id' => 1,
                    'user_id' => $getIdUserMail->user_id,
                    'user_email' => $getIdUserMail->email,
                    'created_at' => time(),
                    'created_by' => Auth::user()->id
                ]
            );
        }
        return $insertMailSend;
    }
    public function EditEmailTemplate($id)
    {
        $getEmailTemplate = Admin_mail_template::where('id', $id)->first();
        return $getEmailTemplate;
    }
    public function PostEditEmailTemplate($id, $request)
    {
        $getEmailTemplate = Admin_mail_template::where('id', $id)->update([
            'template_title' => $request->template_title,
            'template_content' => $request->template_content,
            'updated_by' => Auth::user()->id
        ]);
        return $getEmailTemplate;
    }
    public function EmailConfig()
    {
        $getEmailConfig = Admin_mail_config::where('is_deleted', 0)->orderBy('id', 'desc')->first();
        return $getEmailConfig;
    }
    public function PostEditEmailConfig($request)
    {
        $data = [
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => 'tls',
            'is_deleted' => 0,
            'created_at' => time(),
            'created_by' => Auth::user()->id
        ];
        $emailconfig = Admin_mail_config::where('id', 1)->update($data);
        return  $emailconfig;
    }
    public function GetUserIF()
    {
        $listUser = User_infomation::where('full_name', '!=', null)->get();
        return  $listUser;
    }
    public function AddEmailCampaign()
    {
        $template =  Admin_mail_template::orderBy('id', 'desc')->get();
        return $template;
    }
    public function sendMail($request)
    {
        $id_template = $request->admin_template_id;
        $getEmailTemplate = Admin_mail_template::where('id', '=', $id_template)->first();
        $getEmailConfig = Admin_mail_config::where('id', '=', 1)->first();
        $getAllUser = User::leftJoin('user_infomations', 'user_infomations.user_id', 'users.id')
        ->where('users.role', 2)
        ->select('users.id', 'user_infomations.email')->get();
        if($request->send_email_all){
            $userAll = $getAllUser;
          
        }else{
            $userAll = $request->list_users;
        }
        foreach ($userAll as $value) {
           
            if($request->send_email_all){
                $getEmailUser = User_infomation::where('user_id', $value->id)->first();
              
            }else{
                $getEmailUser = User_infomation::where('user_id', $value)->first();
            }
            try {
                //Bỏ thông tin mail config vào swift smtp
                $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host, $getEmailConfig->mail_port))
                    ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encryption);
                $mailer = new \Swift_Mailer($transport);
                //thiết lập Title, Content mail gửi
                $message = (new \Swift_Message($getEmailTemplate->template_title))
                    ->setFrom($getEmailConfig->mail_username)
                    ->setTo($getEmailUser->email)
                    ->addPart(
                        $getEmailTemplate->template_content,
                        'text/html'
                    );
                $mailer->send($message);
            } catch (\Swift_TransportException $transportExp) {
            }
        }
    }
    public function PostAddEmailCampaignAllUser($request)
    {
        $getAllUser = User::leftJoin('user_infomations', 'user_infomations.user_id', 'users.id')
            ->where('users.role', 2)
            ->select('users.id', 'user_infomations.email')->get();
        for ($i = 0; $i < count($getAllUser); $i++) {
            $getIdUserMail = User_infomation::where('user_id', '=', $getAllUser[$i]->id)->first();
            $insertMailSend = Admin_mail_campaign_detail::create([
                'admin_template_id' => $request->admin_template_id,
                'admin_mail_config_id' => 1,
                'user_id' => $getAllUser[$i]->id,
                'user_email' => $getAllUser[$i]->email,
                'created_by' => Auth::user()->id
            ]);
        }
        return $insertMailSend;
    }
    public function PostAddEmailCampaign($request)
    {
        foreach ($request->list_users as $value) {
            $getIdUserMail = User_infomation::where('user_id', '=', $value)->first();
            $insertMailSend = Admin_mail_campaign_detail::create([
                'admin_template_id' => $request->admin_template_id,
                'admin_mail_config_id' => 1,
                'user_id' => $getIdUserMail->user_id,
                'user_email' => $getIdUserMail->email,
                'created_by' => Auth::user()->id
                
            ]);
        }
        return $insertMailSend;
    }
    public function DeleteEmailTemplate($id)
    {
        $DeleteEmailTemplate = Admin_mail_template::where('id', $id)->delete();
        return $DeleteEmailTemplate;
    }
}
