<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $fillable = ['codigo','nombre','Consentracion','minimo','fabricante','stock','precio','precioiva','costo','fecha_exp','doctor_id'];
}
