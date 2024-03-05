<?php

namespace App\Http\Services;

use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\User;
use App\Models\User_infomation;
use App\Models\Work;
use App\Models\Work_progress;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class WorkService
{
    public function ListWork($request)
    {
        $GetWork =  Work::leftJoin('users', 'users.id', '=', 'works.user_id')
            ->leftJoin('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->leftJoin('positions', 'positions.id', '=', 'user_infomations.positions')
            ->leftJoin('levels', 'levels.id', '=', 'user_infomations.level')
            ->select('user_infomations.full_name', 'positions.name_position', 'works.*')
            ->orderBy('works.id', 'DESC')
            ->where('works.deleted', 0);

        if (isset($request->keyword)) {
            $GetWork = $GetWork
                ->where('users.phone', $request->keyword)
                ->orWhere('user_infomations.full_name','like', "%$request->keyword%")
                ->orWhere('user_infomations.positions','like', "%$request->keyword%")
                ->where('works.deleted', 0);
        }
        $GetWork = $GetWork->paginate(15);
        return $GetWork;
    }
    public function getWork($id)
    {
        $getWork = Work::where('id', $id)->first();
        return $getWork;
    }
    public function getWorkProgress($id)
    {
        $getWorkProgress = Work_propress::where('works', $id)->get();
        return $getWorkProgress;
    }
    public function AddWork()
    {
        $getUsers = User::join('user_infomations', 'user_infomations.user_id', '=', 'users.id')
            ->where('role', 2)->get();
        return $getUsers;
    }
    public function PostAddWorks($request){
        $PostAddWork = Work::insert([
            'user_id' => $request->user_id,
            'work_name' => $request->work_name,
            'note' => $request->note,
            'from' => date(strtotime($request->from)),
            'to' => date(strtotime($request->to)),
            'created' => time(),
            'created_by' => Auth::user()->id
        ]);
        return $PostAddWork;
    }
    public function SendMail($request){
        $getEmailUser = User_infomation::where('user_id', $request->user_id)->first();
        $getEmailTemplate = Admin_mail_template::where('id', '=', 1)->first();
        $getEmailConfig = Admin_mail_config::where('id', '=', 1)->first();
        try {
            //Bỏ thông tin mail config vào swift smtp
            $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host, $getEmailConfig->mail_port))
                ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encryption);
            $mailer = new \Swift_Mailer($transport);
            //thiết lập Title, Content mail gửi
            $message = (new \Swift_Message($request->work_name))
                ->setFrom($getEmailConfig->mail_username)
                ->setTo($getEmailUser->email)
                ->addPart(
                    $request->note,
                    'text/html'
                );
            $mailer->send($message);
        } catch (\Swift_TransportException $transportExp) {
        }
    }
    public function DeleteWork($id){
        $DeleteWork = Work::where('id',$id)->delete();
        return $DeleteWork;
    }
    public function EditWork($id){
        $getWork = Work::where('id',$id)->first();
        return $getWork;
    }
    public function sendMailWorks($id,$request){
        $getEmailUser = User_infomation::where('user_id',$id)->first();
        $getEmailTemplate = Admin_mail_template::where('id', '=', 2)->first();
        $getEmailConfig = Admin_mail_config::where('id', '=', 1)->first();
        try{
            //Bỏ thông tin mail config vào swift smtp
            $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host,$getEmailConfig->mail_port))
            ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encryption);
            $mailer = new \Swift_Mailer($transport);
            //thiết lập Title, Content mail gửi
            $message = (new \Swift_Message($request->work_name))
            ->setFrom($getEmailConfig->mail_username)
            ->setTo($getEmailUser->email)
            ->addPart(
              $request->note,
              'text/html'
          );
            $mailer->send($message);
        }catch (\Swift_TransportException $transportExp){
        }
    }
    public function PostEditWork($id,$request){
        $PostEditWork = Work::where('id',$id)->update([
            'work_name'=>$request->work_name,
            'note'=>$request->note,
            'from'=>date(strtotime($request->from)),
            'to'=>date(strtotime($request->to)),
            'updated_at'=>time(),
            'updater'=>Auth::user()->id
        ]);
        return $PostEditWork;
    }
}
