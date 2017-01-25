<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => 'Administrator', 'slug' => 'admin', 'created_at' => date('Y-m-d H:i:s', strtotime('NOW'))],
            [ 'name' => 'Seller', 'slug' => 'seller', 'created_at' => date('Y-m-d H:i:s', strtotime('NOW'))],
            [ 'name' => 'Operator', 'slug' => 'operator', 'created_at' => date('Y-m-d H:i:s', strtotime('NOW'))]
        ];

        DB::table('roles')->insert($datas);
    }
}
