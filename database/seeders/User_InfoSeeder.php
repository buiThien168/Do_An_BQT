<?php

namespace Database\Seeders;

use App\Models\User_infomation;
use Illuminate\Database\Seeder;

class User_InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_infomation::insert(
            [
                "user_id " => 1,
                "full_name" => "Admin",
                "nick_name" => "Admin",
                "email" => "Admin@gmail.com",
                "sex" => "Nam",
                "date_of_birth" => null,
                "place_of_birth" => null,
                "marital_status" => null,
                "id_number" => null,
                "date_range" => null,
                "passport_issuer" => null,
                "hometown" => null,
                "nationality" => null,
                "nation" => null,
                "religion" => null,
                "permanent_residence" => null,
                "staying" => null,
                "image" => null,
                "employee_type" => null,
                "level" => null,
                "specializes" => null,
                "rooms" => null,
                "positions" => null,
                "status" => null,
                "is_deleted" => 0,
            ]
        );
    }
}
