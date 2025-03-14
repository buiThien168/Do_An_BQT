<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                "name" => "admin",
                "phone" => "0395865097",
                "password" => md5("123456"),
                "active" => 1,
                "role" => 1,
                "is_deleted" => 0,
            ]
        );
    }
}
