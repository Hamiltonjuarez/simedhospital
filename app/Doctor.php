<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [ 'nombreDoctor','apellidosDoctor','codigoDoctor','user_id','tituloDoctor','direccion','logo','nacimiento','sexo','equipoLocal','perfil','marca' ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
    public function historias()
    {
        return $this->hasMany(HistorialClinico::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
