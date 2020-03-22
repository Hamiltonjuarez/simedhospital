<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable=['paciente_id','doctor_id','habitacion_id','title','tipocita','descripcion','start','end','estado'];

    
}
