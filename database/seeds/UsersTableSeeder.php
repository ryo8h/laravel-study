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
			DB::table('users')->insert([
                [
                'name' => 'taro',
                'email' => 'taro@email.com',
                'email_verified_at' => DB::raw('CURRENT_TIMESTAMP'),
                'password' => Hash::make('123'),
                'gender' => 1,
                // 'author' => 0,
                'remember_token' => str_random(10),
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                ],
                [
                'name' => 'hanako',
                'email' => 'hanako@email.com',
                'email_verified_at' => DB::raw('CURRENT_TIMESTAMP'),
                'password' => Hash::make('123'),
                'gender' => 2,
                'remember_token' => str_random(10),
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                ],
            ]);
    }
}
