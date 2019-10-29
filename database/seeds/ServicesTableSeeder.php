<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('services')->insert([
            'serviceName' => 'أستخراج بطاقة رقم قومى',
            'servicePrice' => 50,
            'serviceTime' => 10,
            'serviceDescription'=>'أستخراج بطاقة رقم قومى',
            'serviceAllowedCancelTime' => 2
        ]);
    }
}
