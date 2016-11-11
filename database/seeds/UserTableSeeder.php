<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'role_id'  => 1,
                'name'     => 'Administrator',
                'email'    => 'henry.tran@qsoft.com.vn',
                'is_admin' => true,
                'password' => bcrypt('Admin@123456!'),
                'photo'    => "default-user.png",
            ],
        ]);
    }
}
