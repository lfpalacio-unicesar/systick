<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Antivirus extends Model
{
    // use SoftDeletes;

    protected $table = 'antivirus';

    protected $fillable = [
       'nombre' 
    ];

    // protected $dates = ['delete_at'];

    public function equipos(){
        return $this->hasMany('App\Equipos','antivirus_id');
    }
}
