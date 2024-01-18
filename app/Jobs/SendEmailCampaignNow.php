<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Mail;
use App\Mail\WelcomeEmail;
use DB;


class SendEmailCampaignNow implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){

        $getMailSend = DB::table('admin_mail_campaign_detail')->where('receipt_status',0)->get();
        $getEmailConfig = DB::table('admin_mail_config')->where('id',1)->first();
        foreach ($getMailSend as $items) {
            $getEmailTemplate = DB::table('admin_mail_template')
            ->where('id','=',$items->admin_template_id)
            ->first();
            try{
                //Bỏ thông tin mail config vào swift smtp
                $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host,$getEmailConfig->mail_port))
                ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encryption);
                $mailer = new \Swift_Mailer($transport);

                //thiết lập Title, Content mail gửi
                $message = (new \Swift_Message($getEmailTemplate->template_title))
                ->setFrom($getEmailConfig->mail_username)
                ->setTo($items->user_email)
                ->addPart(
                    $getEmailTemplate->template_content,
                    'text/html'
                );
                $mailer->send($message);
            }catch (\Swift_TransportException $transportExp){
                //update Status gửi thất bại
                DB::table('admin_mail_campaign_detail')->where('id', $items->id)->update(['receipt_status' => 2,'receipt_time' => strtotime('now'),]);
            }
            //update Status gửi thành công
            DB::table('admin_mail_campaign_detail')->where('id', $items->id)->update(['receipt_status' => 1,'receipt_time' => strtotime('now'),]);
        }         
    }
}
