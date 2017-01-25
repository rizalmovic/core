<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => 'Site Name', 'slug' => 'sitename', 'value' => 'Ecommerce', 'created_at' => date('Y-m-d H:i:s', strtotime('NOW')) ],
        ];

        DB::table('settings')->insert($datas);
    }
}
