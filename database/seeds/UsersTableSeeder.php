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
            'roleName' => 'superadmin',
            'slug' =>'superadmin'
        ]);
        DB::table('roles')->insert([
            'roleName' => 'admin',
            'slug' =>'admin'
        ]);

        DB::table('roles')->insert([
            'roleName' => 'employee',
            'slug' =>'employee'

        ]);

        DB::table('roles')->insert([
            'roleName' => 'user',
            'slug' =>'user'

        ]);


        /*
        Insert Users
        */

        DB::table('users')->insert([
            'userName' => 'superadmin',
            'userEmail' => 'superadmin@domain.com',
            'userPassword' => bcrypt('123456789'),
            'roleId'=>1
        ]);

        DB::table('users')->insert([
            'userName' => 'admin',
            'userEmail' => 'admin@domain.com',
            'userPassword' => bcrypt('123456789'),
            'roleId'=>2
        ]);

        DB::table('users')->insert([
            'userName' => 'employee',
            'userEmail' => 'employee@domain.com',
            'userPassword' => bcrypt('123456789'),
            'roleId'=>3
        ]);

        DB::table('users')->insert([
            'userName' => 'user',
            'userEmail' => 'user@domain.com',
            'userPassword' => bcrypt('123456789'),
            'roleId'=>4
        ]);


    }
}
