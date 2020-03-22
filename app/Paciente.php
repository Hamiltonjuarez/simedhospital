<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable=['nombre','habitacion_id','estado_traslado','apellidos','nacimiento','telefono','sexo','civil','codigo','dui','doctor_id','photo_extension','correo','notas','email','teltrabajo','celtrabajo','companiaseguro','nopoliza','nocarnet','asegurado','direccion'];

    public function getAgeAttribute()
	{
		return \Carbon\Carbon::parse($this->nacimiento)->age;
    }

    public function getAvatarUrl()
    {
        if ($this->photo_extension) {
            return asset($this->photo_extension);
        } elseif ($this->sexo=='M') {
            return asset('assets/img/imageprofilem.png');
        } elseif ($this->sexo=='F') {
            return asset('assets/img/imageprofilef.png');
        }
    }
}

/* dr. miguel elias escobar martinez

endodiagnostica
gastrocirugia-gastroenterologia-endoscopia digestiva-intervencionista
endodiagnostico.es@gmail.com
Edif. Centro de diagnostico 2a. planta Clinica No. 24 Colonia Medica S.S.
tel: 22269050
cel: 77004536 */
