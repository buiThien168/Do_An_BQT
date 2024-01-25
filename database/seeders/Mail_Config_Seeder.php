<?php

namespace Database\Seeders;

use App\Models\Admin_mail_config;
use Illuminate\Database\Seeder;

class Mail_Config_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin_mail_config::insert(
            [
                "mail_drive" => null,
                "mail_host" => "smtp.gmail.com",
                "mail_port" => 587,
                "mail_username" => "yatchinvest@gmail.com",
                "mail_password" => "gbgdncosyqbwxrwt",
                "mail_encryption" => "tls",
                "total_send" => 0,
                "created_by" => 1,
                'is_deleted' => 0,
                "created_at" => time(),
                "updated_at" => null
            ]
        );
    }
}
