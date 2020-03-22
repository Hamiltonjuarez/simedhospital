<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Doctor::class, function (Faker $faker) {
    return [
        'nombreDoctor'=>$faker->name(17),
        'apellidosDoctor'=>$faker->name(17),
        'user_id'=>'1'
    ];
});
