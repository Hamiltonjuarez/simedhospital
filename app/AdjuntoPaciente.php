<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjuntoPaciente extends Model
{
    protected $fillable = ['descripcion','adjunto','paciente_id'];

   public function extenAdjunto(){
    if ($this->adjunto) {
        list($name,$extension)=explode('.',$this->adjunto);
        if (strtolower($extension)=='jpg' or strtolower($extension)=='png' or strtolower($extension)=='jpeg') {
            return 'imagen';
        }
        else if (strtolower($extension)=='docx' or strtolower($extension)=='doc'){
            return 'word';
        }
        else if (strtolower($extension)=='xls' or strtolower($extension)=='xlsx'){
            return 'excel';
        }
        else if (strtolower($extension)=='pdf'){
            return 'pdf';
        }
    }
   }
}
