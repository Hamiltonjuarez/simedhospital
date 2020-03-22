<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biopsia extends Model
{

    //
    protected $fillable=['precioBiopsia', 'status', 'procedimiento_id'];

  
    public function procedimiento()
    {
        return $this->belongsTo(Procedimiento::class);
    }
}
