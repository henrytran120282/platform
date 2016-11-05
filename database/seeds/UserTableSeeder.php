<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Administrator',
                'email' => 'henry.tran@qsoft.com.vn',
                'is_admin' => true,
                'password' => bcrypt('Admin@123456!'),
                'photo' => "default-user.png",
                'permission' => '{"page":["index","create","edit","update","destroy"],"post":["index","create","edit","update","destroy"],"category":["index","create","edit","update","destroy"],"tag":["index","create","edit","update","destroy"],"comment":["approve","destroy"],"menu":["index","create","edit","update","destroy"],"media":["index","upload","destroy"],"theme":["index","edit","destroy"],"widget":["index","create","edit","destroy"],"gallery":["index","create","edit","destroy"],"gallery-images":["index","create","edit","destroy"],"contacts":["index","destroy"],"roles":["index","create","edit","destroy"],"users":["create","edit","destroy","profile"],"setting":["index"]}'
            ]
        ]);
    }
}
