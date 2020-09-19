<?php

namespace App\Observers; //ubicación derectorio observer
use App\Tickets; //importo el modelo que escuchare
use Auth;
use App\Bitacora;

//defino nombre de la clase del observer que luego se realacionara en el service provider
class TicketsObserver
{
    public function created(Tickets $ticket){

        $bitacora = new Bitacora();
        

        $msg = 'El usuario <b>'.$ticket->usuarios->name.'</b> creó un ticket con ID <b>'.$ticket->id.'</b> con la siguiente información: ';

        // if($ticket->isDirty('user_id')){
        //     $msg .= '<li type="square"><b>Usuario:</b> '.$ticket->user_id.'</li>';
        // }

        if ($ticket->isDirty('servicio_id')){
            $msg .= '<li type="square"><b>Servicio:</b> '.$ticket->servicios->nombre.'.</li>';
        }

        if($ticket->isDirty('estado_id')){
            $msg .= '<li type="square"><b>Estado:</b> '.$ticket->estados->nombre.'.</li>';
        }

        if($ticket->isDirty('titular')){
            $msg .= '<li type="square"><b>Titular:</b> '.$ticket->titular.'.</li>';
        }

        if($ticket->isDirty('asunto')){
            $msg .= '<li type="square"><b>Asunto:</b> '.$ticket->asunto.'.</li>';
        }

        if($ticket->isDirty('equipo_id')){
            $msg .= '<li type="square"><b>Equipo:</b> '.$ticket->equipos->sticker.'.</li>';
        }

        $msg .= 'de forma correcta.';        

        $bitacora->usuario_id = $ticket->user_id;
        $bitacora->accion = $msg;
        $bitacora->ip = \Request::ip();
        $bitacora->save();

    }

    public function updated(Tickets $ticket){

        $bitacora = new Bitacora(); 

        $msg = 'El usuario <b>'.Auth::user()->name.'</b> actualizó el ticket con ID <b>'.$ticket->id.'</b> con la siguiente información: ';

        if($ticket->isDirty('estado_id')){
            $msg .= '<li type="square"><b>Estado:</b> '.$ticket->estados->nombre.'.</li>';
        }

        if($ticket->isDirty('asignado')){
            $msg .= '<li type="square"><b>Asignado a:</b> '.$ticket->asignado2->name.'.</li>';
        }

        $msg .= 'de forma correcta.';        

        $bitacora->usuario_id = Auth::user()->id;
        $bitacora->accion = $msg;
        $bitacora->ip = \Request::ip();
        $bitacora->save();
    }

}

