<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    //
    protected $fillable = [
        'paciente_id', 'doctor_id', 'tipoexamen_id', 'hallazgos', 'descripcion', 'diagnostico'
    ];
}
