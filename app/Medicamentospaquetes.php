<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamentospaquetes extends Model
{
    protected $fillable = ['medicamento_id','cantidad','combo_id'];
}
