<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class Level_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert(
            [
                "qualification_name " =>"Đại học",
                "note " =>"Đại học",
                "created " =>null,
                "created_by " =>null,
                "updated_at " =>null,
                "updater " =>null,
                "deleted " =>0,
            ]
        );
    }
}
