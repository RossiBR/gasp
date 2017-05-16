<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsigniaMadeira extends Model
{
    protected $table = 'insignia_madeira';

    public function ramo()
    {
        return $this->belongsTo('App\Ramo');
    }

    public function linha_formacao()
    {
        return $this->belongsTo('App\LinhaFormacao');
    }

    public function associado()
    {
        return $this->belongsTo('App\Associado');
    }


}
