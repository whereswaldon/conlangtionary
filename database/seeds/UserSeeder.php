<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'name' => $_ENV['TEST_USER_NAME'],
            'email' => $_ENV['TEST_USER_EMAIL'],
            'password' => bcrypt($_ENV['TEST_USER_PASSWORD']),
        ]);
        DB::table('users')->insert([
            'name' => $_ENV['ADMIN_DEFAULT_USER_NAME'],
            'email' => $_ENV['ADMIN_DEFAULT_USER_EMAIL'],
            'password' => bcrypt($_ENV['ADMIN_DEFAULT_USER_PASSWORD']),
        ]);
    }
}
