<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formador extends Model
{
    protected $table = 'formador';
    
     public function associado()
    {
        return $this->belongsTo('App\Associado');
    }

}
