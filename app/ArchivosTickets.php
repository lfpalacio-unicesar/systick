<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ArchivosTickets extends Model
{
    // use SoftDeletes;

    protected $table = 'tickets_archivos';

    protected $fillable = [
        'nombre',
        'ruta',
        'ticket_id'
    ];

    // protected $dates = ['delete_at'];
}
