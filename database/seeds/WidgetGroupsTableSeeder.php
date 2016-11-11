<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('widget_groups')->insert([
            [
                'theme_id' => 1,
                'name'     => 'post_slider',
            ],
            [
                'theme_id' => 1,
                'name'     => 'sidebar',
            ],
        ]);
    }
}
