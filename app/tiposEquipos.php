<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class tiposEquipos extends Model
{
    // use SoftDeletes;

    protected $table = 'tiposequipos';

    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];

    public function equipos(){
        return $this->hasMany('App\Equipos','tipo_id');
    }

    public function tickets(){
        return $this->hasMany('App\Tickets','tipo_id');
    }
}
