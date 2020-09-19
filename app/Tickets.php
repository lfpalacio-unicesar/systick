<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    // use SoftDeletes;

    protected $table = 'tickets';

    protected $fillable = ([        
        'servicio_id',        
        'user_id',
        'estado_id',
        'titular',
        'asunto',
        'descripcion',
        'equipo_id',
        'asignado',

    ]);

    // protected $dates = ['delete_at'];

    public function usuarios(){
        return $this->belongsTo('App\User','user_id');
    }

    public function tiposEquipos(){
        return $this->belongsTo('App\tiposEquipos','tipo_id');
    }

    public function servicios(){
        return $this->belongsTo('App\Servicios','servicio_id');
    }

    public function estados(){
        return $this->belongsTo('App\EstadosTickets','estado_id');
    }

    public function asignados(){
        //asocia en el belongsToMany el modelo que desea relacionar, el nombre de la tabla pivot, los campos pertenecientes a la tabla pivot
        return $this->belongsToMany('App\User','tickets_asignados','ticket_id','user_id');
    }

    public function asignado2(){
        return $this->belongsTo('App\User','asignado');
    }

    public function equipos(){
        return $this->belongsTo('App\Equipos','equipo_id');
    }
        
}
