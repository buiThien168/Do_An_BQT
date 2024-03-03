<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(Mail_Config_Seeder::class);
        $this->call(User_InfoSeeder::class);
        $this->call(RoomsSeeder::class);
        $this->call(Positon_Seeder::class);
        $this->call(Level_Seeder::class);
        $this->call(Specri_Seeder::class);
        $this->call(EmployType_Seeder::class);
    }
}
