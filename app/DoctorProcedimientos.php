<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorProcedimientos extends Model
{
    protected $fillable=['doctor_id', 'procedimiento_tipo_id'];
}
