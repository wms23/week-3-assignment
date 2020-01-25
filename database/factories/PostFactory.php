<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraphs(4,true),
        'author_id' => \App\User::get()->random()->id,
        'is_published' => $faker->boolean(70)
    ];
});
