<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{

    //
    protected $fillable = [
        'procedimiento_tipo_id', 'plantilla', 'precioProcedimiento', 'descripcion', 'contenido','status','doctorinvitado'
    ];

}
