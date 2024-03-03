<?php

namespace Database\Seeders;

use App\Models\Employee_type;
use Illuminate\Database\Seeder;

class EmployType_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee_type::insert(
            [
                "name" => "Thực Tập",
                "note" => "Thực Tập",
                "created" => null,
                "created_by" => null,
                "updated_at" => null,
                "updater" => null,
                "deleted" => 0,
            ]
        );
    }
}
