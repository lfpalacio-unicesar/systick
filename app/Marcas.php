<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Marcas extends Model
{
    // use SoftDeletes;

    protected $table = 'marcas';
    
    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];

    public function equipos(){
        return $this->hasMany('App\Equipos','marca_id');
    }
}
