<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('posts')->insert([
        //     [
        //      'user_id' => '4',
        //      'title' => 'hoge',
        //      'content' => 'test0',
        //      'image' => 'null'
        //     ],
        // ]);
        factory(Post::class,10)->create();

    }
}
