<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Paciente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name(24),
        'apellidos'=>$faker->name(25),
        'email' => $faker->unique()->safeEmail,
        'nacimiento'=>$faker->datetime,
        'telefono'=>$faker->text(12),
        'email' => $faker->unique()->safeEmail,
        'sexo'=>Str::random(1),
        'civil'=>$faker->text(12),
        'codigo'=>Str::random(7),
        'dui'=>$faker->text(7),
        'doctor_id'=>'1',
        'peso'=>'86',
        'estatura'=>'1.65',
        'presion' =>'120',
    ];
});
