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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('EscoteirosSP'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Associado::class,  function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'registro' => random_int(1, 10000) ,
        'registro_digito' => random_int(0, 9),
    ];
});

$factory->define(App\UEL::class,  function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'sigla' => 'GEX',
        'numeral' => random_int(1, 10000),
        'regiao' => 'SP'
    ];
});