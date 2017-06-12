<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoPeriodo extends Model
{
    protected $table = 'curso_periodo';

    public function modulos()
    {
        return $this->hasMany('App\CursoModulo', 'curso_periodo_id');
    }

}
