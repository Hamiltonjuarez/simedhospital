<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mix extends Model
{
    //
    //EDAD
    static function edad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($mes_diferencia==0){
            if ($dia_diferencia>=0){
                return $ano_diferencia;
            } else {
                return $ano_diferencia-1;
            }
        }
        if ($mes_diferencia>0){
            return $ano_diferencia;
        } else {
            return $ano_diferencia-1;
        }
    }


    static function fecha($datetime){
        list($date, $hora) = explode(' ', $datetime);
        list($year, $month, $day) = explode('-', $date);
        $date=$day.'/'.$month.'/'.$year;
        $data=['fecha' => $date, 'hora' => $hora];
        return $data;
    }




}
