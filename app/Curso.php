<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function criador()
    {
        return $this->belongsTo('App\Users');
    }

}
