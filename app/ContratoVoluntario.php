<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoVoluntario extends Model
{
    protected $table = 'contrato_voluntario';

    public function associado()
    {
        return $this->belongsTo('App\Associado');
    }


}
