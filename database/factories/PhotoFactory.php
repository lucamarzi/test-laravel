<?php

use Faker\Generator as Faker;
use App\Models\Album;

$factory->define(\App\Models\Photo::class, function (Faker $faker) {

    $cats = ['animals','nature','sports'];
    return [
        //
        'album_id' => Album::inRandomOrder()->first()->id,
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'img_path' => $faker->imageUrl(640, 480, $faker->randomElement($cats))
    ];
});
