<?php

namespace App\Http\Controllers\Admin\EmailCampaign;

use App\Http\Controllers\Controller;
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
    public function AddEmailCampaign(){
        $listUser=DB::table('user_infomations')
        ->where('full_name','!=',null)->get();
        $template = DB::table('admin_mail_template')->orderBy('admin_mail_template.id','desc')->get();
        return view('Admin.EmailCampaign.AddEmailCampaign',['listUser'=>$listUser,'template'=>$template]);
    }
    public function PostAddEmailCampaign(Request $request){
        if(isset($request->send_email_all)){
            $getAllUser = DB::table('users')
            ->leftJoin('user_infomations','user_infomations.user_id','users.id')
            ->where('users.role',2)
            ->select('users.id','user_infomations.email')->get();
            for ($i = 0; $i < count($getAllUser); $i++) { 
                $getIdUserMail = DB::table('user_infomations')->where('user_id','=',$getAllUser[$i]->id)->first(); 
                $insertMailSend = DB::table('admin_mail_campaign_detail')->insert(
                    [
                        'admin_template_id' => $request->admin_template_id,
                        'admin_mail_config_id'=>1,
                        'user_id'=>$getAllUser[$i]->id,
                        'user_email'=>$getAllUser[$i]->email,
                        'created_at'=>time(),
                        'created_by'=>Auth::user()->id      
                    ]
                );  
            }
            SendEmailCampaignNow::dispatch(1);
            
        }else{
            for ($i = 1; $i <= count($request->list_users); $i++) { 
                $getIdUserMail = DB::table('user_infomations')->where('user_id','=',$request->list_users[$i-1])->first(); 
                $insertMailSend = DB::table('admin_mail_campaign_detail')->insert(
                    [
                        'admin_template_id' => $request->admin_template_id,
                        'admin_mail_config_id'=>1,
                        'user_id'=>$getIdUserMail->user_id,
                        'user_email'=>$getIdUserMail->email,
                        'created_at'=>time(),
                        'created_by'=>Auth::user()->id      
                    ]
                );  
            }
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


    public function PostEditEmailConfig(Request $request){
        try{
            $transport = (new \Swift_SmtpTransport($request->mail_host,$request->mail_port))
            ->setUsername($request->mail_username)->setPassword($request->mail_password)->setEncryption('tls');
            $mailer = new \Swift_Mailer($transport);
            $message = (new \Swift_Message('Test mail'))
            ->setFrom([$request->mail_username => 'Account Test'])
            ->setTo([$request->mail_username,$request->mail_username => 'Name test'])
            ->setBody('Test email');
            $result = $mailer->send($message);

            $data = [
                'mail_host' => $request->mail_host,
                'mail_port' => $request->mail_port,
                'mail_username' => $request->mail_username,
                'mail_password' => $request->mail_password,
                'mail_encryption' => 'tls',
                'is_deleted' => 0,
                'created_at' => time(),
                'created_by'=>Auth::user()->id
            ];

            $emailconfig = DB::table('admin_mail_config')->where('admin_mail_config.id',1)->update($data);
            return redirect()->back()->with('msg', 'Change email information successfully');
        }
        catch (\Swift_TransportException $transportExp){

            return redirect()->back()->with('msg', 'The setting information is incorrect, please check again');
        }   
    }
    public function EmailConfig(){
        $getEmailConfig = DB::table('admin_mail_config')->where('is_deleted',0)->orderBy('id','desc')->first();
        return view('Admin.EmailCampaign.EmailConfig',
            [
                'getEmailConfig'=>$getEmailConfig,
            ]
        );
    }


    public function ListEmailTemplate(){
        $getEmailTemplate = DB::table('admin_mail_template')->where('admin_mail_template.is_deleted',0)->orderBy('admin_mail_template.id','desc')->paginate(20);
        return view('Admin.EmailCampaign.ListEmailTemplate',
            [
                'getEmailTemplate'=>$getEmailTemplate,
            ]
        );
    }

    public function DeleteEmailTemplate($id){
        DB::table('admin_mail_template')->where('admin_mail_template.id',$id)->update(['is_deleted'=>1,'updated_at'=>time(),'updated_by'=>Auth::user()->id]);
        return redirect()->back();
    }

    public function EditEmailTemplate($id){
        $getEmailTemplate = DB::table('admin_mail_template')->where('admin_mail_template.id',$id)->first();
        
        return view('Admin.EmailCampaign.EditEmailTemplate',
            [
                'getEmailTemplate'=>$getEmailTemplate,
            ]
        );
    }

    public function PostEditEmailTemplate($id,Request $request){
        $getEmailTemplate = DB::table('admin_mail_template')
        ->where('id',$id)
        ->update(
            [
                'template_title'=>$request->template_title,
                'template_content'=>$request->template_content,
                'updated_at'=>time(),
                'updated_by'=>Auth::user()->id
            ]
        );
        return redirect('/admin/email-marketing/email-template');
    }

    public function AddEmailTemplate(){
        return view('Admin.EmailCampaign.AddEmailTemplate');
    }
    public function PostAddEmailTemplate(Request $request){
        DB::table('admin_mail_template')
        ->insert(
            [
                'template_title'=>$request->template_title,
                'template_content'=>$request->template_content,
                'created_at'=>time(),
                'updated_by'=>Auth::user()->id
            ]
        );

        return redirect('/admin/email-marketing/email-template');
        
        
    }
}













