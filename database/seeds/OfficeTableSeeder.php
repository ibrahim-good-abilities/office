<?php

use Illuminate\Database\Seeder;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert([
            'officeName' => 'Alexandria Office',
            'officeAddress' => 'Alexandria',
            'officePhone' => '038544215',
            'officeMobile' => '0125658985',
            'officeEmail' => 'alexandria@office.com',
            'cityId' => 1,
            'officeStartTime' => '9:00',
            'officeBreak' => '12:30',
            'officeEndTime' => '3:00',
        ]);
    }
}
