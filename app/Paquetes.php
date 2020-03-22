<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
   protected $fillable = ['nombre','costo','precio','doctor_id'];
}
