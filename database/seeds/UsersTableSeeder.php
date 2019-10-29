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
            'roleName' => 'Superadmin',
            'slug' =>'superadmin'
        ]);
        DB::table('roles')->insert([
            'roleName' => 'Admin',
            'slug' =>'admin'
        ]);

        DB::table('roles')->insert([
            'roleName' => 'Employee',
            'slug' =>'employee'

        ]);

        DB::table('roles')->insert([
            'roleName' => 'User',
            'slug' =>'user'

        ]);


        /*
        Insert Users
        */

        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@domain.com',
            'password' => bcrypt('123456789'),
            'roleId'=>1,
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('123456789'),
            'roleId'=>2,
            'officeId' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'employee',
            'email' => 'employee@domain.com',
            'password' => bcrypt('123456789'),
            'roleId'=>3,
            'officeId' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'employee2',
            'email' => 'employee2@domain.com',
            'password' => bcrypt('123456789'),
            'roleId'=>3,
            'officeId' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@domain.com',
            'password' => bcrypt('123456789'),
            'roleId'=>4
        ]);


    }
}
