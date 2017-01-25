<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'username' => 'admin', 'name' => 'Administrator', 'email' => 'admin@example.net', 'password' => Hash::make('password'), 'created_at' => date('Y-m-d H:i:s', strtotime('NOW')) ],
            [ 'username' => 'seller#1', 'name' => 'Seller #1', 'email' => 'seller1@example.net', 'password' => Hash::make('password'), 'created_at' => date('Y-m-d H:i:s', strtotime('NOW')) ],
            [ 'username' => 'seller#2', 'name' => 'Seller #2', 'email' => 'seller2@example.net', 'password' => Hash::make('password'), 'created_at' => date('Y-m-d H:i:s', strtotime('NOW')) ]
        ];

        DB::table('users')->insert($datas);
    }
}
