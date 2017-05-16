<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InsigniaMadeira;

class Associado extends Model
{
    protected $table = 'associado';

	public function ims()
    {
        return $this->hasMany('App\InsigniaMadeira', 'associado_id');
    }

	public function contratos()
    {
        return $this->hasMany('App\ContratoVoluntario', 'associado_id');
    }
    

}
