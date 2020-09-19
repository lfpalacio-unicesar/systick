<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficinas extends Model
{
    protected $table='oficinas';
    
    protected $fillable=([
        'nombre',
        'tipo'
    ]);

    public function usuarios(){
        return $this->hasMany('App\User','oficina_id');
    }

    public function equipos(){
        return $this->hasMany('App\Equipos','oficina_id');
    }
}
