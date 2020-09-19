<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Suite extends Model
{
    // use SoftDeletes;

    protected $table = 'suite';

    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];
    
}
