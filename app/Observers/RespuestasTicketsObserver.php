<?php

namespace App\Observers; //ubicacion directorio observer
use App\TicketsRespuestas; //importo el modelo que escuchare
use Auth;
use App\Bitacora;

class RespuestasTicketsObserver
{
    public function creating (TicketsRespuestas $response){
        
        $bitacora = new Bitacora();

        $msg = 'El usuario <b>'.Auth::user()->name.'</b> generó una respuesta asociada al ticket con ID <b>'.$response->ticket_id.'</b> con la respuesta:';

        if($response->isDirty('respuesta')){
            // $msg .= '';
            $msg .= '<li type="square">'.$response->respuesta.'</li>';
        }

        $msg .= 'de forma correcta.';

        $bitacora->usuario_id = Auth::user()->id;
        $bitacora->accion = $msg;
        $bitacora->ip = \Request::ip();
        $bitacora->save();
    }
}