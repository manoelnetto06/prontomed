<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    function paciente() {
        return $this->belongsTo('App\Paciente');
    }
}
