<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tiposMantenimientos extends Model
{
    protected $table='tipos_mantenimientos';

    protected $fillable = [
        'nombre'
    ];
}
