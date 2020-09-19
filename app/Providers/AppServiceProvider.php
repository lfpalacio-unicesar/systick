<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Notificaciones;
use Auth;

//importo clases de Observer
use App\Observers\TicketsObserver;
use App\Tickets;

use App\Observers\RespuestasTicketsObserver;
use App\TicketsRespuestas;

use App\Observers\MantenimientosObserver;
use App\Mantenimientos;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //variable global que maneja contador de notificaciones
        view()->composer('*', function($view){
            if(Auth::check()){
                $contNoti = Notificaciones::where('usuario_id',Auth::user()->id)->where('visto',0)->count();
                $view->with('contNoti', $contNoti);
            }
        });

        //variable global que maneja las notificaciones
        view()->composer('*', function($view){
            if(Auth::check()){
                $Notificaciones = Notificaciones::where('usuario_id',Auth::user()->id)->where('visto',0)->latest()->get()->take(4);
                $view->with('Notificaciones', $Notificaciones);
            }
        });

        //variable global que relaciona el ObserverTickets
        Tickets::observe(TicketsObserver::class);

        //variable global que relaciona el ObserverMantenimiento
        Mantenimientos::observe(MantenimientosObserver::class);

        //variable global que relaciona el ObserverRespuestasTickets
        TicketsRespuestas::observe(RespuestasTicketsObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
