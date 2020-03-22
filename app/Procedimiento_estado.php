<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimiento_estado extends Model
{
    protected $fillable = ['paciente_id','habitacion_id','tipoprocedimiento_id ','estado'];
}
