<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_operacion extends Model
{
    protected $fillable = ['paciente_id','habitacion_id','doctor_id','anestesiologo_id','primer_id','segundo_id','instrumentalista','circular_id'];
}
