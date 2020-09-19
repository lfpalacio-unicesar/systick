<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsRespuestas extends Model
{
    protected $table = 'tickets_respuestas';

    protected $fillable = ([
        'ticket_id',
        'usuario_id',
        'respuesta',
    ]);

    public function usuarios(){
        return $this->belongsTo('App\User','usuario_id');
    }

}
