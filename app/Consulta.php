<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = ['tituloConsulta','detalleConsulta','diagnostico','prescripcion','receta_id','precioConsulta','status'];

    public function historial(){
        return $this->belongsTo('App\HistorialClinico');
    }
}
