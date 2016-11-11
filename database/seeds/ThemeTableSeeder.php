<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            [
                'name'          => 'smallpine',
                'version'       => '1.0',
                'author'        => 'qsoftvietnam',
                'author_url'    => 'http://qsoftvietnam.com',
                'description'   => 'Default Theme',
                'image_preview' => 'Screenshot.png',
                'status'        => true,
            ],
        ]);
    }
}
