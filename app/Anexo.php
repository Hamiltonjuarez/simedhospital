<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $fillable = ['tipo','diagnostico','tratamiento','estado_alta','medicamentos_id','agregados','paciente_id','doctor_id','desde','hasta','ingresodesde','ingresohasta'];
}
