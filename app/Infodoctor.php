<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infodoctor extends Model
{
    protected $fillable = ['doctor_id', 'estudios', 'experiencia', 'servicio', 'membrecias'];
}
