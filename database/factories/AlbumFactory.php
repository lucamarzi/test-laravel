<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(\App\Models\Album::class, function (Faker $faker) {
    return [
        //
        'album_name' => $faker->name,
        'description' => $faker->text('128'),
        'user_id' => User::inRandomOrder()->first()->id
    ];
});
