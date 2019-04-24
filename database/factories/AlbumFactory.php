<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(\App\Models\Album::class, function (Faker $faker) {

    $cats = ['animals','nature','sports'];
    return [
        //
        'album_name' => $faker->name,
        'album_thumb' => $faker->imageUrl(640, 480, $faker->randomElement($cats)),
        'description' => $faker->text('128'),
        'user_id' => User::inRandomOrder()->first()->id
    ];
});
