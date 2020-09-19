<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Sistemas extends Model
{
    // use SoftDeletes;

    protected $table = 'sistemas';
    
    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];

    public function equipos(){
        return $this->hasMany('App\Equipos','sistema_id');
    }
}
