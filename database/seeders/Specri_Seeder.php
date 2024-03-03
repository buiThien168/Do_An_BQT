<?php

namespace Database\Seeders;

use App\Models\Specialize;
use Illuminate\Database\Seeder;

class Specri_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialize::insert(
            [
                "name_specializes" => "Fontend",
                "note" => "Fontend",
                "created_by" => null,
                "created" => null,
                "updater" => null,
                "updated_at" => null,
                "deleted" => 0,
            ]
        );
    }
}
