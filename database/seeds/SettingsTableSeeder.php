<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'company_name',
            'value' => 'E-Cafe',
        ]);
        DB::table('settings')->insert([
            'name' => 'upload_logo',
            'value' => '/images/logo/logo.png',
        ]);
        DB::table('settings')->insert([
            'name' => 'company_phone',
            'value' => '00201286036550',
        ]);
        DB::table('settings')->insert([
            'name' => 'defualt_tax',
            'value' => 0,
        ]);

    }
}
