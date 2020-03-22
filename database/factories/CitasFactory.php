<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Cita::class, function (Faker $faker) {
    return [
        'paciente_id'=>rand(1,50),
        'tipoExamen_id'=>rand(1,5),
        'doctor_id'=>rand(1,50),
        'status' =>$faker->randomElement(['REALIZADO','PENDIENTE'])
    ];
});
