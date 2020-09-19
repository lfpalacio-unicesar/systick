<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class EstadosTickets extends Model
{
    // use SoftDeletes;

    protected $table ='tickets_estados';

    protected $fillable = [
        'nombre'
    ];

    // protected $dates = ['delete_at'];

    public function tickets(){
        return $this->hasMany('App\Tickets','estado_id');
    }
}
