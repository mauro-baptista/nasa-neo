<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Neo::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->date('Y-m-d'),
        'reference' => $faker->numerify('######'),
        'name' => $faker->word,
        'speed' => $faker->randomFloat(3, 10, 100),
        'is_hazardous' => false,
    ];
});

$factory->state(App\Models\Neo::class, 'is_hazardous', function () {
    return [
        'is_hazardous' => true,
    ];
});

$factory->state(App\Models\Neo::class, 'is_not_hazardous', function () {
    return [
        'is_hazardous' => false,
    ];
});


