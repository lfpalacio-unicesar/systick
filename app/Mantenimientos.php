<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimientos extends Model
{
    protected $table='mantenimientos';

    protected $fillable = [
        'tipo',
        'estado',
        'acciones',
        'conclusiones',
        'equipo_id',
        'fingreso',
        'fprogramada',
        'fentrega',
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
        'estado_equipo',
        'motivo_baja',
        'nombre',
        'ip',
        'mac',
        'asignado',
        'usuario_id',
        'responsable',
    ];

    // public function softwares2(){
    //     return $this->belongsToMany('App\Softwares','software_equipo_mantenimiento')
    //     ->withPivot('equipo_id');
    // }

    // public function equipos2(){
    //     return $this->belongsToMany('App\Equipos','software_equipo_mantenimiento')
    //     ->withPivot('software_id');
    // }

    public function tipos(){
        return $this->belongsTo('App\tiposEquipos','tipo_id');
    }

    public function oficinas(){
        return $this->belongsTo('App\Oficinas','oficina_id');
    }

    public function usuarios(){
        return $this->belongsTo('App\User','usuario_id');
    }

    public function responsables(){
        return $this->belongsTo('App\User','responsable');
    }

    public function marcas(){
        return $this->belongsTo('App\Marcas','marca_id');
    }

    public function office(){
        return $this->belongsTo('App\Suite','suite_id');
    }

    public function sistemas(){
        return $this->belongsTo('App\Sistemas','sistema_id');
    }

    public function antivirus(){
        return $this->belongsTo('App\Antivirus','antivirus_id');
    }

    // public function equipo(){
    //     return $this->belongsTo('App\Equipos','equipo_id');
    // }


}
