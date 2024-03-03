<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class Positon_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::insert(
            [
                "name_position" =>"Thực tập",
                "note" =>"",
                "luong_ngay" =>null,
                "created_by" =>null,
                "created" =>null,
                "updated_at" =>null,
                "updater" =>null,
                "deleted" =>0,
            ]
        );
    }
}
