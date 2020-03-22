<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entrada_inventario extends Model
{
    protected $fillable = ['medicamento_id','cantidad','proveedor','fechaexp','fecha_ingreso'];
}
