<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    protected $fillable = [ 'nombreClinica', 'slogan', 'direccion', 'telefonos', 'celular', 'facebook', 'instagram', 'paginaWeb', 'email' ];
}
