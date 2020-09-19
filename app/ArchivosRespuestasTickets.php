<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivosRespuestasTickets extends Model
{
    protected $table = 'tickets_respuestas_archivos';

    protected $fillable = [
        'nombre',
        'ruta',
        'respuesta_id',
    ];
}
