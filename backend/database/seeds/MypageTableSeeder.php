<?php

use Illuminate\Database\Seeder;
use App\Models\Mypage;
use Illuminate\Support\Facades\DB;

class MypageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('mypages')->insert([
            'user_id' => '4',
            'profile_image' => 'no',
            'gender' => '0',
            'age' => '0',
            'introduction' => '初めまして。'

        ]);

        // factory(Mypage::class,10)->create();
    }
}
