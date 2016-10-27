<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

        $categoryLimit = 4;
        $postLimit = 20;
        $date = Carbon::now()->format('Y-m-d H:i:s');

        for($z = 0; $z < $categoryLimit; $z++){
        	$titleCategory = $faker->word();
            DB::table('terms')->insert(
            	[
	            'name' => $titleCategory,
	            'slug' => str_slug($titleCategory),
	            'taxonomy' => "category",
            	]
        	);
        }

        for ($i = 0; $i < $postLimit; $i++) {
        	$title = $faker->sentence();
            $idPost = DB::table('posts')->insertGetId(
            	[
	            'post_author' => 1,
	            'post_content' => $faker->paragraph(150),
	            'post_title' => $title,
	            'post_name' => str_slug($title),
	            'post_type' => "post",
	            'created_at' => $date,
	            'updated_at' => $date,
            	]
        	);

        	DB::table('term_relationships')->insert(
            	[
	            'object_id' => $idPost,
	            'term_taxonomy_id' => rand(1,4),
            	]
        	);
        	DB::table('post_meta')->insert(
            	[
            	'post_id' => $idPost,
	            'meta_key' => "featured_img",
	            'meta_value' => "uploads/sample-image-".rand(1,7).".jpg",
            	]
        	);
        }

        //----Seed menu-----
        $idMenu = DB::table('posts')->insertGetId(
            [
            'post_author' => 1,
            'post_content' => "",
            'post_title' => "Home",
            'post_name' => 'home',
            'post_type' => "nav-menu",
            'comment_status' => "close",
            'menu_group' => "main-menu",
            'post_mime_type' => 'nav-menu',
            'created_at' => $date,
            'updated_at' => $date,
            ]
        );

        DB::table('post_meta')->insert(
            [
            'post_id' => $idMenu,
            'meta_key' => "_nav_item_parent",
            'meta_value' => "",
            ]
        );

        DB::table('post_meta')->insert(
            [
            'post_id' => $idMenu,
            'meta_key' => "_nav_item_url",
            'meta_value' => url()->full(),
            ]
        );

        DB::table('post_meta')->insert(
            [
            'post_id' => $idMenu,
            'meta_key' => "_nav_item_type",
            'meta_value' => "home",
            ]
        );
    }
}
