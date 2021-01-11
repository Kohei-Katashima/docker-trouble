<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('users')->insert([
        //     'name' => 'test',
        //     'email' => 'test@test.com',
        //     'password' => bcrypt('test0000')

        // ]);
        factory(User::class, 10)->create();
    }
}
