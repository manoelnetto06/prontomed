<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    function paciente() {
        return $this->belongsTo('App\Paciente');
    }
}
