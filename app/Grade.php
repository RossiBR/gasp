<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade';

	public function ramo()
    {
        return $this->belongsTo('App\Ramo');
    }

    public function linha_formacao()
    {
        return $this->belongsTo('App\LinhaFormacao');
    }

    public function tipo_curso()
    {
        return $this->belongsTo('App\TipoCurso');
    }

    public function modulos()
    {
        return $this->hasMany('App\GradeModulo', 'grade_id');
    }

}
