<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoModulo extends Model
{
    protected $table = 'curso_modulo';

    	public function curso()
    {
        return $this->belongsTo('App\Curso');
    }

    public function modulo()
    {
        return $this->belongsTo('App\Modulo');
    }


}
