<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table='bitacora';

    protected $fillable = [
        'usuario_id',
        'accion',
        'ip',
    ];

    protected $dates = ['delete_at'];

    public function users(){
        return $this->belongsTo('App\User','usuario_id');
    }

    // defino scope
    public function scopeBuscar($query, $data){

        if($data->finicio != null){
            $query->whereDate('bitacora.created_at','>=',$data->finicio);
        }

        if($data->ffinal != null){
            $query->whereDate('bitacora.created_at','<=',$data->ffinal);
        }

        if($data->texto != null){
            $query->where('accion','like','%'.$data->texto.'%');
        }

        if($data->cantidad != null){
            $query->take($data->cantidad);
        }

        // if($data->usuario != null){
        //     $usr = $data->usuario;
        //     //funcion que permite hacer un join entre 2 modelos distintos
        //     $query->leftjoin('users',function($join) use ($usr){
        //         $join->where('name','like','%'.$usr.'%');
        //         $join->on('users.id','=','bitacora.usuario_id');                
        //     });           
        // }

        $query->orderBy('bitacora.created_at','desc');
        //$query->latest('bitacora.created_at');

        return $query;
    }
}
