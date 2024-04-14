<?php

namespace App\Http\Services;

use App\Models\Admin_mail_campaign_detail;
use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Position;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_infomation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalaryService
{
    public function ListSalary($request)
    {
        $GetSalarys = User::leftJoin('salary', 'users.id', '=', 'salary.user_id')
            ->leftJoin('user_infomations', 'users.id', '=', 'user_infomations.user_id')
            ->leftJoin('positions', 'user_infomations.positions', '=', 'positions.id')
            ->leftJoin('levels', 'user_infomations.level', '=', 'levels.id')
            ->select(
                'user_infomations.full_name',
                'users.id',
                'positions.name_position',
                'salary.basic_salary',
                'salary.perk_salary',
                'salary.insuranc_salary',
                'salary.created',
                'levels.qualification_name'
            )
            ->orderBy('users.id', 'DESC')
            ->where('user_infomations.full_name', '!=', null);
        if (isset($request->keyword)) {
            $GetSalarys = $GetSalarys
                ->where('user_infomations.nick_name','like', '%'.$request->keyword.'%');
        }
        $GetSalarys = $GetSalarys->paginate(15);
        return $GetSalarys;
    }
    public function EditSalary($id)
    {
        $getSalary = Salary::where('user_id', $id)->first();
        return $getSalary;
    }
    public function PostEditSalary($id, $request)
    {
        $getSalary = $this->EditSalary($id);
        if ($getSalary == null) {
            Salary::create([
                'user_id' => $id,
                'basic_salary' => $request->basic_salary,
                'perk_salary'=>$request->perk_salary,
                'insuranc_salary'=>$request->insuranc_salary,
                'created_by' => Auth::user()->id,
                'updater' => null,
            ]);
        } else {
            Salary::where('user_id', $id)->update([
                'user_id' => $id,
                'basic_salary' => $request->basic_salary,
                'perk_salary'=>$request->perk_salary,
                'insuranc_salary'=>$request->insuranc_salary,
                'updater' => Auth::user()->id,
            ]);
        }
    }
    public function ListSalaryStaff()
    {
        $getStaff = User::leftJoin('user_infomations', 'users.id', '=', 'user_infomations.user_id')
            ->leftJoin('salary', 'users.id', '=', 'salary.user_id')
            ->leftJoin('positions', 'user_infomations.positions', '=', 'positions.id')
            ->select('users.id', 'user_infomations.full_name', 'salary.basic_salary', 'positions.name_position')
            ->where('users.role', 2)
            ->orderBy('users.id', 'desc')
            ->paginate(15);
        return  $getStaff;
    }
    public function Wage()
    {
        $getStaff = User::leftJoin('user_infomations', 'users.id', '=', 'user_infomations.user_id')
            ->leftJoin('salary', 'users.id', '=', 'salary.user_id')
            ->leftJoin('positions', 'user_infomations.positions', '=', 'positions.id')
            ->leftJoin(
                DB::raw('(SELECT user_id, SUM(value) as total_bonuses FROM bonuses GROUP BY user_id) as bonuses'),
                'users.id',
                '=',
                'bonuses.user_id'
            )
            ->leftJoin(
                DB::raw('(SELECT user_id, SUM(value) as total_disciplines FROM disciplines GROUP BY user_id) as disciplines'),
                'users.id',
                '=',
                'disciplines.user_id'
            )
            ->leftJoin(
                DB::raw('(SELECT user_id, SUM(work_month) as total_work_month FROM user_tracks WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) GROUP BY user_id) as user_tracks'),
                'users.id',
                '=',
                'user_tracks.user_id'
            )
            ->select(
                'users.id',
                'user_infomations.full_name',
                'salary.basic_salary',
                'salary.perk_salary',
                'salary.insuranc_salary',
                'positions.name_position',
                DB::raw('IFNULL(bonuses.total_bonuses, 0) as total_bonuses'),
                DB::raw('IFNULL(disciplines.total_disciplines, 0) as total_disciplines'),
                DB::raw('IFNULL(user_tracks.total_work_month, 0) as total_work_month')
            )
            ->where('users.role', 2)
            ->orderBy('users.id', 'desc')
            ->paginate(15);

        return $getStaff;
    }
    public function sendMail($id,$request)
    {
        $template_title = "Bảng Lương Tháng 5";
        $getEmailTemplate = "";
        $getEmailConfig = Admin_mail_config::where('id', '=', 1)->first();
        $getEmailUser = User_infomation::where('user_id',$id)->first();
        try {
            //Bỏ thông tin mail config vào swift smtp
            $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host, $getEmailConfig->mail_port))
                ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encryption);
            $mailer = new \Swift_Mailer($transport);
            //thiết lập Title, Content mail gửi
            $message = (new \Swift_Message($template_title))
                ->setFrom($getEmailConfig->mail_username)
                ->setTo($getEmailUser->email)
                ->addPart(
                    $getEmailTemplate,
                    'text/html'
                );
            $mailer->send($message);
        } catch (\Swift_TransportException $transportExp) {
        }
    }
    public function PostAddEmailCampaign($id,$request)
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
}
