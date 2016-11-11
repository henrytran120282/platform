<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            [
                'name'  => 'site_title',
                'value' => 'QSoft Vietnam',
            ],
            [
                'name'  => 'site_tagline',
                'value' => 'Content Management System',
            ],
            [
                'name'  => 'email_administrator',
                'value' => 'hoaitn@qsoft.com.vn',
            ],
            [
                'name'  => 'frontpage_blog',
                'value' => false,
            ],
            [
                'name'  => 'view_post_index',
                'value' => '10',
            ],

            [
                'name'  => 'image_thumbnail_width',
                'value' => '150',
            ],
            [
                'name'  => 'image_thumbnail_height',
                'value' => '150',
            ],

            [
                'name'  => 'image_medium_width',
                'value' => '300',
            ],
            [
                'name'  => 'image_medium_height',
                'value' => '300',
            ],

            [
                'name'  => 'image_large_width',
                'value' => '1024',
            ],
            [
                'name'  => 'image_large_height',
                'value' => '800',
            ],

            [
                'name'  => 'menu_name',
                'value' => serialize(['main-menu']),
            ],
        ]);
    }
}
