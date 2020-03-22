<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{

    protected $fillable=['paciente_id','doctor_id','consulta_id','procedimiento_id','anexo_id'];

    public function doctores()
    {
        return $this->belongsTo(Doctor::class);
    }
}
