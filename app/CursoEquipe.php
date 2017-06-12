<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoEquipe extends Model
{
    protected $table = 'curso_equipe';

    public function associado()
    {
        return $this->belongsTo('App\associado');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }
}
