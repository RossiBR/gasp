<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeModulo extends Model
{
    protected $table = 'grade_modulo';

    	public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function modulo()
    {
        return $this->belongsTo('App\Modulo');
    }


}
