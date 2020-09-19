<?php

namespace App;
use App\Mantenimientos;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class Equipos extends Model
{
    // use SoftDeletes;

    protected $table='equipos';

    protected $fillable = [        
        'tipo_id',
        'critico',
        'oficina_id',
        'marca_id',
        'modelo',
        'sticker',
        'sticker_monitor',
        'sticker_teclado',
        'sticker_mouse',
        'procesador',
        'ram',
        'almacenamiento',
        'sistema_id',
        'estadoSistema',
        'suite_id',
        'estadoSuite',
        'antivirus_id',
        'estadoAntivirus',
        'fcompra',
        'finstalacion',
        'fbaja',
        'estado',
        'motivo_baja',
        'nombre',
        'ip',
        'mac',
        'asignado',        
        'usuario_id',
        
    ];

    // protected $dates = ['delete_at'];

    public function tipos(){
        return $this->belongsTo('App\tiposEquipos','tipo_id');
    }

    public function marcas(){
        return $this->belongsTo('App\Marcas','marca_id');
    }

    public function sistemas(){
        return $this->belongsTo('App\Sistemas','sistema_id');
    }

    public function antivirus(){
        return $this->belongsTo('App\Antivirus','antivirus_id');
    }

    public function suites(){
        return $this->belongsTo('App\Suite','suite_id');
    }

    public function oficinas(){
        return $this->belongsTo('App\Oficinas','oficina_id');
    }

    public function usuarios(){
        return $this->belongsTo('App\User','usuario_id');
    }

    public function softwares(){
        //asocia en el bolongsToMany el modelo que desea relacionar, el nombre de la tabla pivot, los campos pertenecientes a la tabla pivot.
        return $this->belongsToMany('App\Softwares','software_equipo','equipo_id','software_id');
    }

    public function softwares2(){
        return $this->belongsToMany('App\Softwares','software_equipo_mantenimiento')
        ->withPivot('mantenimiento_id');
    }

    public function mantenimientos2(){
        return $this->belongsToMany('App\Mantenimientos','software_equipo_mantenimiento')
        ->withPivot('software_id');
    }

    public function mantenimientos($id){
        $cantidad =  Mantenimientos::where('equipo_id',$id)->count();
        return $cantidad;
    }
}
