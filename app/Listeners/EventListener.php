<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

//agrego modelos
use Illuminate\Auth\Events\Login;
use Auth;
use App\Bitacora;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //
        $event->bitacora = new Bitacora();
        
        $event->bitacora->usuario_id = Auth::user()->id;
        // $event->bitacora->accion_id =  Auth::user()->id;
        $event->bitacora->ip = \Request::ip();
        $event->bitacora->accion = 'El usuario <b>'.Auth::user()->name.' </b>inició sesion de forma correcta.';

        // Guardado de la informacion en la tabla bitacora
        $event->bitacora->save();
    }
}
