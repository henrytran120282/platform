<?php

use Illuminate\Database\Seeder;

class WidgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('widgets')->insert([
        	[
	            'group_id' => 1,
	            'class_name' => 'App\Widgets\defaultWidget\PostSlider',
	            'options' => serialize([
                        'baseID'=>str_random(10),
                        'title'=>'Post Slider'
                    ]),
	            'order' => 1,
            ],
            [
            	'group_id' => 2,
	            'class_name' => 'App\Widgets\defaultWidget\CategoryWidget',
	            'options' => serialize([
                    'baseID'=>str_random(10),
                    'title'=>'Widget Category',
                    ]),
	            'order' => 1,
            ],
            [
                'group_id' => 2,
                'class_name' => 'App\Widgets\defaultWidget\RecentPostWidget',
                'options' => serialize([
                    'baseID'=>str_random(10),
                    'title'=>'Recent Post',
                    ]),
                'order' => 2,
            ],
        ]);
    }
}
