<?php

namespace App\Observers; //ubicacion directorio observer
use App\Mantenimientos; //importo el modelo a escuchar
use Auth;
use App\Bitacora;

//defino nombre de la clase del observer que luego se realacionara en el service provider
class MantenimientosObserver
{
    public function created(Mantenimientos $mante){
        
        $bitacora = new Bitacora();

        $msg = 'El usuario <b>'.Auth::user()->name.'</b> creó un Mantenimiento con ID <b>'.$mante->id.'</b> y sticker equipo # <b>'.$mante->sticker.' </b>con la siguiente información: ';

        if($mante->isDirty('tipo')){
            if( $mante->tipo == 1 ){
                $msg .= '<li type="square"><b>Tipo:</b> Preventivo.</li>';    
            }else{
                $msg .= '<li type="square"><b>Tipo:</b> Correctivo.</li>';
            }            
        }               

        if($mante->isDirty('sticker')){
            $msg .= '<li type="square"><b>Sticker equipo:</b> '.$mante->sticker.'.</li>';
        }

        if($mante->isDirty('fingreso')){
            $msg .= '<li type="square"><b>Fecha ingreso:</b> '.$mante->fingreso.'.</li>';
        }

        if($mante->isDirty('fprogramada')){
            $msg .= '<li type="square"><b>Fecha programada:</b> '.$mante->fprogramada.'.</li>';
        }

        if($mante->isDirty('fentrega')){
            $msg .= '<li type="square"><b>Fecha entrega:</b> '.$mante->fentrega.'.</li>';
        }

        if($mante->isDirty('estado')){
            $msg .= '<li type="square"><b>Estado recibido:</b> '.$mante->estado.'.</li>';
        }

        if($mante->isDirty('acciones')){
            $msg .= '<li type="square"><b>Acciones realizadas:</b> '.$mante->acciones.'.</li>';
        } 

        if($mante->isDirty('conclusiones')){
            $msg .= '<li type="square"><b>Conclusiones:</b> '.$mante->conclusiones.'.</li>';
        } 

        $msg .= 'de forma correcta.';

        $bitacora->usuario_id = Auth::user()->id;
        $bitacora->accion = $msg;
        $bitacora->ip = \Request::ip();
        $bitacora->save();
    }

    public function updated(Mantenimientos $mante){
        
        $bitacora = new Bitacora();

        $msg = 'El usuario <b>'.Auth::user()->name.'</b> modificó el Mantenimiento con ID <b>'.$mante->id.'</b> y sticker equipo # <b>'.$mante->sticker.' </b> con la siguiente información: ';
        
        if($mante->isDirty('fprogramada')){
            $msg .= '<li type="square"><b>Fecha programada:</b> '.$mante->fprogramada.'.</li>';
        }

        if($mante->isDirty('fentrega')){
            $msg .= '<li type="square"><b>Fecha entrega:</b> '.$mante->fentrega.'.</li>';
        }        

        if($mante->isDirty('acciones')){
            $msg .= '<li type="square"><b>Acciones realizadas:</b> '.$mante->acciones.'.</li>';
        } 

        if($mante->isDirty('conclusiones')){
            $msg .= '<li type="square"><b>Conclusiones:</b> '.$mante->conclusiones.'.</li>';
        } 

        $msg .= 'de forma correcta.';

        $bitacora->usuario_id = Auth::user()->id;
        $bitacora->accion = $msg;
        $bitacora->ip = \Request::ip();
        $bitacora->save();
    }
}