<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
        Insert roles
        */
        
        DB::table('roles')->insert([
            'role_name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'captain',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'cashier',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'customer',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'parista',
        ]);

        /* 
        Insert Users
        */

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('123456789'),
            'role_id'=>1
        ]);

        DB::table('users')->insert([
            'name' => 'captain',
            'email' => 'captain@domain.com',
            'password' => bcrypt('123456789'),
            'role_id'=>2
        ]);

        DB::table('users')->insert([
            'name' => 'cashier',
            'email' => 'cashier@domain.com',
            'password' => bcrypt('123456789'),
            'role_id'=>3
        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@domain.com',
            'password' => bcrypt('123456789'),
            'role_id'=>4
        ]);

        DB::table('users')->insert([
            'name' => 'parista',
            'email' => 'parista@domain.com',
            'password' => bcrypt('123456789'),
            'role_id'=>5
        ]);
    }
}
