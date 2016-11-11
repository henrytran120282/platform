<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'post_id'    => 1,
                'content'    => '<p>Lorem ipsum dolor sit amet, illum appetere ei cum, ut sit affert
	            					mandamus expetendis. Semper qualisque ad sea, vel timeam elaboraret ex,
	            					eu mutat choro sit. Duo ad eros animal legendos. Duo te illud mundi congue.
	            					Reque fabellas phaedrum in vix.</p>',
                'approved'   => true,
                'author'     => "Henry Tran",
                'email'      => str_random(10) . '@gmail.com',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
