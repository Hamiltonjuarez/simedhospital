<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal_habitacion extends Model
{
    protected $fillable =  ['cargo','habitacion_id','personal_id'];
}
