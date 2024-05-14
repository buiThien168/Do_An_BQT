<?php

namespace App\Http\Services;

use App\Models\Admin_mail_campaign_detail;
use App\Models\Admin_mail_config;
use App\Models\Admin_mail_template;
use App\Models\Position;
use App\Models\Salary;
use App\Models\User;
use App\Models\User_infomation;
use Faker\Core\Number;
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
        $luong_co_ban = $request->basic_salary;
        $thang = date('n');
        $nam = date('Y');
        if ($thang == 2) {
            $so_ngay_lam = 28;
        } elseif ($thang == 4 || $thang == 6 || $thang == 9 || $thang == 11) {
            $so_ngay_lam = 30;
        } else {
            $so_ngay_lam = 31;
        }
        $songay_nghi_chunhat = 0;
        for ($i = 1; $i <= $so_ngay_lam; $i++) {
            $ngay_trong_thang = date('N', strtotime("$nam-$thang-$i"));
            if ($ngay_trong_thang == 7) {
                $songay_nghi_chunhat++;
            }
        }
        $songay_lam_thucte = $so_ngay_lam - $songay_nghi_chunhat;
        $don_gia_ngay = $luong_co_ban / $songay_lam_thucte;
        $month = date('n');
        $template_title = 'KẾ TOÁN - THÔNG BÁO BẢNG LƯƠNG THÁNG ' . $month . '';
        $year = date('Y');
        // 
        $dongia_CONG = $don_gia_ngay;
        $thanh_tien_CONG = $dongia_CONG * $request->total_work_month;
        $stt_NGHI = $songay_lam_thucte - $request->total_work_month;
        $thanh_tien_NGHI = $stt_NGHI * $dongia_CONG;
        $stt_PHU_CAP = 1;
        $dongia_PHU_CAO = $request->perk_salary ? $request->perk_salary : 0;
        $thanh_tien_PHU_CAP = $stt_PHU_CAP * $dongia_PHU_CAO;
        $stt_THUONG = 1;
        $dongia_THUONG = $request->total_bonuses;
        $thanh_tien_THUONG = floatval($request->total_bonuses);
        $stt_PHAT = 1;
        $dongia_PHAT = $request->total_disciplines;
        $thanh_tien_PHAT = $request->total_disciplines;
        if ($request->insuranc_salary == '0') {
            $stt_BHXH = 0;
            $dongia_BHXH = 0;
            $thanh_tien_BHXH = 0;
        } else {
            $stt_BHXH = 1;
            $dongia_BHXH =  $request->insuranc_salary;
            $thanh_tien_BHXH =  $request->insuranc_salary;
        }
        if($request->total_work_month == 0){
            $thanh_tien_CONG_format = 0;
        }else{
            $thanh_tien_CONG_format = ($thanh_tien_CONG + $thanh_tien_PHU_CAP + $thanh_tien_THUONG - $thanh_tien_BHXH - $thanh_tien_PHAT);
        }
        $tong_tien = number_format($thanh_tien_CONG_format, 0, '.', ',');
        $getEmailConfig = Admin_mail_config::where('id', '=', 1)->first();
        $getEmailUser = User_infomation::where('user_id', $id)->first();
        $getEmailTemplate = $this->template_mail_saraly($getEmailUser->full_name, $month, $request->basic_salary, $request->total_work_month, $dongia_CONG, $thanh_tien_CONG, $stt_NGHI, $don_gia_ngay, $thanh_tien_NGHI, $stt_PHU_CAP, $dongia_PHU_CAO, $thanh_tien_PHU_CAP, $stt_THUONG, $dongia_THUONG, $thanh_tien_THUONG, $stt_PHAT, $dongia_PHAT, $thanh_tien_PHAT, $stt_BHXH, $dongia_BHXH, $thanh_tien_BHXH, $tong_tien);
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
    public function template_mail_saraly($full_name,$thang,$LUONG_CO_BAN,$stt_CONG,$dongia_CONG,$thanh_tien_CONG,$stt_NGHI,$dongia_NGHI,$thanh_tien_NGHI,$stt_PHU_CAP,$dongia_PHU_CAO, $thanh_tien_PHU_CAP,$stt_THUONG,$dongia_THUONG,$thanh_tien_THUONG,$stt_PHAT,$dongia_PHAT,$thanh_tien_PHAT,$stt_BHXH,$dongia_BHXH,$thanh_tien_BHXH,$tong_tien){
        $template_mail_saraly = '
        <div>
        <span style="font-size: 14pt;
    font-family: "times new roman", serif;">Dear Mr <b> ' . $full_name . ',</b></span><br>

        <span style="font-size: 14pt;
    font-family: "times new roman", serif;">Dưới đây là chi tiết bảng lương tháng ' . $thang . ' . Bạn vui lòng kiểm tra lại các thông tin trong bảng lương:<br></span>

        <p style="font-size: 14pt;
    font-family: "times new roman", serif;
    color: #538135;"><b><i>' . $full_name . '</i></b><br></p>

        <span style="border-collapse: collapse; width: 100%; font-size: 14pt;
        font-family: "times new roman", serif;">* Lương cơ bản: ' . $LUONG_CO_BAN . ' VND</span>

        <table style="border-collapse: collapse; width: 100%; font-size: 14pt;
        font-family: "times new roman", serif;" border="1">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Nội dung</th>
                    <th>Buổi</th>
                    <th>Đơn giá</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Số ngày công tháng 03/2024</td>
                    <td style="text-align: center;">' . $stt_CONG . '</td>
                    <td style="text-align: center;">' . number_format($dongia_CONG) . ' VND</td>
                    <td style="text-align: center;">' . number_format($thanh_tien_CONG) . ' VND</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Số ngày nghỉ</td>
                    <td style="text-align: center;">' . $stt_NGHI . '</td>
                    <td style="text-align: center;">' . number_format($dongia_NGHI) . ' VND</td>
                    <td style="text-align: center;"> - ' . number_format($thanh_tien_NGHI) . ' VND</td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td>Phụ cấp</td>
                    <td style="text-align: center;">' . $stt_PHU_CAP . '</td>
                    <td style="text-align: center;">' . number_format($dongia_PHU_CAO) . ' VND</td>
                    <td style="text-align: center;">' . number_format($thanh_tien_PHU_CAP) . ' VND</td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td>Thưởng</td>
                    <td style="text-align: center;">' . $stt_THUONG . '</td>
                    <td style="text-align: center;">' . number_format($dongia_THUONG) . ' VND</td>
                    <td style="text-align: center;">' . number_format($thanh_tien_THUONG) . ' VND</td>
                </tr>
                <tr>
                    <td style="text-align: center;">5</td>
                    <td>Phạt</td>
                    <td style="text-align: center;">' . $stt_PHAT . '</td>
                    <td style="text-align: center;">' . number_format($dongia_PHAT) . ' VND</td>
                    <td style="text-align: center;">' . number_format($thanh_tien_PHAT) . ' VND</td>
                </tr>
                <tr>
                    <td style="text-align: center;">6</td>
                    <td>BHXH</td>
                    <td style="text-align: center;">' . $stt_BHXH . '</td>
                    <td style="text-align: center;">' . number_format($dongia_BHXH) . ' VND</td>
                    <td style="text-align: center;">' . number_format($thanh_tien_BHXH) . ' VND</td>
                </tr>
                <tr>
                    <td colspan="2"  style="text-align: center;">TONG</td>
                    <td style="text-align: center;" colspan="3">' . $tong_tien . ' VND</td>
                </tr>
            </tbody>
        </table>
        <p style="font-size: 14pt;
        font-family: "times new roman", serif;">Bạn vui lòng kiểm tra và phản hồi lại email này</p>
        <span style="font-size: 14pt;
        font-family: "times new roman", serif;">Trân trọng!</span><br>
        <span>--</span><br>
        <span>Name: Phạm Thị Nhẫn</span><br>
        <span> Title: Human Resources</span><br>
        <span> ketoan@hachitechsolution.com</span><br>
        <span> 0356.732.201 or 0964.851.983</span><br>
        <span> Name: Hachitech Solution</span><br>
        <span> Tầng 3 Nhà Khách Việt Bắc Quân khu 1, Đường Z115, Phường Tân Thịnh, TP Thái Nguyên</span><br>
        <span>-------------------------------------------------------</span><br>
        <span>Lưu ý vui lòng mã hóa tệp trước khi gửi</span><br>
        <span> and Regards!</span><br>
    </div>
        ';
        return $template_mail_saraly;
    }
}
