<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'user_id' => factory(App\User::class),
        'title' => $faker->word,
        'content' => $faker->realText, 
    ];
});
