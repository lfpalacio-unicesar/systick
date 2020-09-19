<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Servicios extends Model
{
    // use SoftDeletes;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];

    public function tickets(){
        return $this->hasMany('App\Tickets','servicio_id');
    }

}
