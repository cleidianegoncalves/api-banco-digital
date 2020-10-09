<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conta;
use Faker\Generator as Faker;

$factory->define(Conta::class, function (Faker $faker) {
    return [
        'conta' => 12345,
        'saldo' => 3000.00
    ];
});
