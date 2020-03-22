<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = ['tituloReceta','descripcionReceta','paciente_id','consulta_id','doctor_id','plantilla_id'];
}
