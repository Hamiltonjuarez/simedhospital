<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoProcedimiento extends Model
{
    protected $fillable=['expediente','procedencia','diagnostico_clinico','intervencion','anestesiologo','anestesia','equipo','procedimiento_id'];
}
