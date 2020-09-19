<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Softwares extends Model
{
    // use SoftDeletes;

    protected $table='softwares';

    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];
    
    public function equipos(){
        return $this->belongsToMany('App\Equipos','software_equipo','equipo_id','software_id');
    }

    public function equipos2(){
        return $this->belongsToMany('App\Equipos','software_equipo_mantenimiento')
        ->withPivot('mantenimiento_id');
    }

    public function mantenimientos2(){
        return $this->belongsToMany('App\Mantenimientos','software_equipo_mantenimiento')
        ->withPivot('equipo_id');
    }
}
