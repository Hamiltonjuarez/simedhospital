<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
   protected $fillable = ['paciente_id','total_venta','clinica_id','cliente'];
}
