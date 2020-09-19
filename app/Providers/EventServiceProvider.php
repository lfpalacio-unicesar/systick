<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    //lo comente
    // protected $listen = [
    //     'App\Events\Event' => [
    //         'App\Listeners\EventListener',
    //     ],
    // ];

    /*Listen es un arrreglo donde registro los listeners que voy creando. el primero escucha cuando ingreso al sistema, el segundo cuando me salgo.
    los uso para registrar en la bitacora los accesos y salidas del sistema*/
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\EventListener',            
        ],

        'Illuminate\Auth\Events\Logout' =>[
            'App\Listeners\EventListenerLogout',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
