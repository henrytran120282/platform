<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'          => 1,
                'name'        => 'Administrator',
                'description' => 'This is supper admin',
                'type'        => 'admin',
                'permission'  => '{"page":["index","create","edit","update","destroy"],"post":["index","create","edit","update","destroy"],"category":["index","create","edit","update","destroy"],"tag":["index","create","edit","update","destroy"],"comment":["approve","destroy"],"menu":["index","create","edit","update","destroy"],"media":["index","upload","destroy"],"theme":["index","edit","destroy"],"widget":["index","create","edit","destroy"],"gallery":["index","create","edit","destroy"],"gallery-images":["index","create","edit","destroy"],"contacts":["index","destroy"],"roles":["index","create","edit","destroy"],"users":["create","edit","destroy","profile"],"setting":["index"]}',
                'status'      => true,
            ],
        ]);
    }
}
