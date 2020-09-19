<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class softwareEquipoMantenimiento extends Model
{
    protected $table='software_equipo_mantenimiento';
    
    protected $fillable = [
        'equipo_id',
        'software_id',
        'mantenimiento_id',
        
    ];

    public function softwares(){
        return $this->belongsTo('App\Softwares','software_id');
    }
    
}
