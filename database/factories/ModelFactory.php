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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Language::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});
$factory->define(App\Word::class, function ($faker) {
    return [
        'ascii_string' => $faker->word,
    ];
});
$factory->define(App\Definition::class, function ($faker) {
    return [
        'definition_number' => rand(0,100),
        'definition_text' => $faker->sentence,
    ];
});
$factory->define(App\Description::class, function ($faker) {
    return [
        'description' => $faker->paragraph,
    ];
});
