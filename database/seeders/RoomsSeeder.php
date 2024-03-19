<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::insert(
            [
                "room_name" => "VP DEV",
                "note" => "",
                "created" => null,
                "created_by" => null,
                "updater" => null,
                "deleted" => 0,
            ]
        );
    }
}
