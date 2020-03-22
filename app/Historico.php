<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = ['peso','presion','temperatura','glucosa','estatura','mejora','paciente_id'];
}
