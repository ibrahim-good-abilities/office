<?php

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
        $this->call(CityTableSeeder::class);
        $this->call(OfficeTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
