<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mypage;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\App;

$factory->define(Mypage::class, function (Faker $faker) {
    return [
        //
        'user_id' => factory(App\User::class),
        'profile_image' => $faker->fileExtension,
        'gender' => '0',
        'age' => '0',
        'introduction' => $faker->realText, 
    ];
});
