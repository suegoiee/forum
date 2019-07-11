<?php

use App\Models\Category;

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(15),
        'slug' => $faker->slug,
    ];
});
