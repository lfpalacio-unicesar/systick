<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
//Rutas agregadas por el comando auth
//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Route::get('/home', 'HomeController@index')->name('home');




 Route::get('/index', function () {
     return view('dashboard');
 });

//esta ruta es la que debo mostrar para mensaje de no superar la validacion de la ruta 
 Route::get('/home', function () {
    return view('home');
});

Route::get('/', function () {
    return view('auth.login');
});



Route::group(['middleware' => ['superAdminUser']], function(){

    //Rutas Equipos
    Route::get('/equipos/ver_equipos','equiposController@list')->middleware('auth');
    Route::get('/equipos/nuevo_equipo','equiposController@create')->middleware('auth');
    Route::post('/equipos/guardar','equiposController@save')->middleware('auth');
    Route::get('/equipos/editar/{id}','equiposController@edit')->middleware('auth');
    Route::post('/equipos/actualizar','equiposController@update')->middleware('auth');
    //Route::get('/equipos/detalles/{id}','equiposController@details')->middleware('auth');
    //Route::get('/equipos/borrar/{id}','equiposController@delete')->middleware('auth');
    Route::post('/equipos/borrar','equiposController@delete')->middleware('auth');

    //Rutas Usuarios
    Route::get('/usuarios/ver_usuarios','usuariosController@list')->middleware('auth');
    Route::get('/usuarios/nuevo_usuario','usuariosController@create')->middleware('auth');
    Route::post('/usuarios/guardar','usuariosController@save')->middleware('auth');
    //Route::get('/usuarios/editar/{id}','usuariosController@edit')->middleware('auth');
    //Route::post('/usuarios/actualizar','usuariosController@update')->middleware('auth');
    Route::get('/usuarios/activar/{id}','usuariosController@activate')->middleware('auth');


    //Rutas Oficinas
    Route::get('/oficinas/ver_oficinas','oficinasController@list')->middleware('auth');
    Route::get('/oficinas/nueva_oficina','oficinasController@create')->middleware('auth');
    Route::post('/oficinas/guardar','oficinasController@save')->middleware('auth');
    Route::get('/oficinas/editar/{id}','oficinasController@edit')->middleware('auth');
    Route::post('/oficinas/actualizar','oficinasController@update')->middleware('auth');
    Route::get('/oficinas/borrar/{id}','oficinasController@delete')->middleware('auth');


    //Rutas Subdirecciones
    Route::get('/subdirecciones/ver_subdirecciones','subdireccionesController@list')->middleware('auth');
    Route::get('/subdirecciones/nueva_subdireccion','subdireccionesController@create')->middleware('auth');
    Route::post('/subdirecciones/guardar','subdireccionesController@save')->middleware('auth');
    Route::get('/subdirecciones/editar/{id}','subdireccionesController@edit')->middleware('auth');
    Route::post('/subdirecciones/actualizar','subdireccionesController@update')->middleware('auth');
    Route::get('/subdirecciones/borrar/{id}','subdireccionesController@delete')->middleware('auth');


    //Rutas Coordinaciones
    Route::get('/coordinaciones/ver_coordinaciones','coordinacionesController@list')->middleware('auth');
    Route::get('/coordinaciones/nueva_coordinacion','coordinacionesController@create')->middleware('auth');
    Route::post('/coordinaciones/guardar','coordinacionesController@save')->middleware('auth');
    Route::get('/coordinaciones/editar/{id}','coordinacionesController@edit')->middleware('auth');
    Route::post('/coordinaciones/actualizar','coordinacionesController@update')->middleware('auth');
    Route::get('/coordinaciones/borrar/{id}','coordinacionesController@delete')->middleware('auth');


    //Rutas Servicios
    Route::get('/servicios/ver_servicios','serviciosController@list')->middleware('auth');
    Route::get('/servicios/nuevo_servicio','serviciosController@create')->middleware('auth');
    Route::post('/servicios/guardar','serviciosController@save')->middleware('auth');
    Route::get('/servicios/editar/{id}','serviciosController@edit')->middleware('auth');
    Route::post('/servicios/actualizar','serviciosController@update')->middleware('auth');
    Route::get('/servicios/borrar/{id}','serviciosController@delete')->middleware('auth');


    //Rutas Antivirus
    Route::get('/antivirus/ver_antivirus','antivirusController@list')->middleware('auth');
    Route::get('/antivirus/nuevo_antivirus','antivirusController@create')->middleware('auth');
    Route::post('/antivirus/guardar','antivirusController@save')->middleware('auth');
    Route::get('/antivirus/editar/{id}','antivirusController@edit')->middleware('auth');
    Route::post('/antivirus/actualizar','antivirusController@update')->middleware('auth');
    Route::get('/antivirus/borrar/{id}','antivirusController@delete')->middleware('auth');


    //Rutas Marcas
    Route::get('/marcas/ver_marcas','marcasController@list')->middleware('auth');
    Route::get('/marcas/nueva_marca','marcasController@create')->middleware('auth');
    Route::post('/marcas/guardar','marcasController@save')->middleware('auth');
    Route::get('/marcas/editar/{id}','marcasController@edit')->middleware('auth');
    Route::post('/marcas/actualizar','marcasController@update')->middleware('auth');
    Route::get('/marcas/borrar/{id}','marcasController@delete')->middleware('auth');


    //Rutas Sistemas
    Route::get('/sistemas/ver_sistemas','sistemasController@list')->middleware('auth');
    Route::get('/sistemas/nuevo_sistema','sistemasController@create')->middleware('auth');
    Route::post('/sistemas/guardar','sistemasController@save')->middleware('auth');
    Route::get('/sistemas/editar/{id}','sistemasController@edit')->middleware('auth');
    Route::post('/sistemas/actualizar','sistemasController@update')->middleware('auth');
    Route::get('/sistemas/borrar/{id}','sistemasController@delete')->middleware('auth');


    //Rutas Tipos
    Route::get('/tipos/ver_tipos','tiposController@list')->middleware('auth');
    Route::get('/tipos/nuevo_tipo','tiposController@create')->middleware('auth');
    Route::post('/tipos/guardar','tiposController@save')->middleware('auth');
    Route::get('/tipos/editar/{id}','tiposController@edit')->middleware('auth');
    Route::post('/tipos/actualizar','tiposController@update')->middleware('auth');
    Route::get('/tipos/borrar/{id}','tiposController@delete')->middleware('auth');


    //Rutas Suites
    Route::get('/suite/ver_suite','suiteController@list')->middleware('auth');
    Route::get('/suite/nueva_suite','suiteController@create')->middleware('auth');
    Route::post('/suite/guardar','suiteController@save')->middleware('auth');
    Route::get('/suite/editar/{id}','suiteController@edit')->middleware('auth');
    Route::post('/suite/actualizar','suiteController@update')->middleware('auth');
    Route::get('/suite/borrar/{id}','suiteController@delete')->middleware('auth');


    //Rutas Softwares
    Route::get('/softwares/ver_softwares','softwaresController@list')->middleware('auth');
    Route::get('/softwares/nuevo_software','softwaresController@create')->middleware('auth');
    Route::post('/softwares/guardar','softwaresController@save')->middleware('auth');
    Route::get('/softwares/editar/{id}','softwaresController@edit')->middleware('auth');
    Route::post('/softwares/actualizar','softwaresController@update')->middleware('auth');
    Route::get('/softwares/borrar/{id}','softwaresController@delete')->middleware('auth');


    //Rutas Bitacora
    Route::get('/bitacora/listar','bitacoraController@list');
    Route::get('/bitacora/consultar','bitacoraController@search');
    Route::post('/bitacora/consultar','bitacoraController@search');


    //Rutas Tickets
    Route::get('/tickets/ver_tickets','ticketsController@list')->middleware('auth');
    Route::get('/tickets/nuevo_ticket','ticketsController@create')->middleware('auth');
    Route::post('/tickets/guardar','ticketsController@save')->middleware('auth');
    Route::get('/tickets/ver/{id}','ticketsController@see')->middleware('auth');
    Route::get('/tickets/editar/{id}','ticketsController@edit')->middleware('auth');
    Route::post('/tickets/actualizar','ticketsController@update')->middleware('auth');
    Route::get('/tickets/borrar/{id}','ticketsController@delete')->middleware('auth');

    //Rutas Estadisticas
    Route::get('/estadisticas/ver','estadisticasController@list')->middleware('auth');
    Route::get('/estadisticas/tiposServicios','graficasController@tiposServiciosTickets')->middleware('auth');
    Route::get('/estadisticas/tiposEquipos','graficasController@tiposEquiposTickets')->middleware('auth');
    Route::get('/estadisticas/ticketsOficinas','graficasController@ticketsOficinas')->middleware('auth');
    Route::get('/estadisticas/ticketsEquipos','graficasController@ticketsEquipos')->middleware('auth');
    Route::get('/estadisticas/ticketsEquipos/{anio}/{mes}','graficasController@ticketsEquipos')->middleware('auth');
    Route::get('/estadisticas/usuariosMasTickets','graficasController@usuariosMasTickets')->middleware('auth');
    Route::get('/estadisticas/ticketsMes/{anio}/{mes}','graficasController@ticketsMes')->middleware('auth');
    Route::get('/estadisticas/mantenimientosMes/{anio}','graficasController@mantenimientosMes')->middleware('auth');
    Route::get('/estadisticas/tipoManteMes/{anio}','graficasController@tipoManteMes')->middleware('auth');
    Route::get('/estadisticas/usuariosMante','graficasController@usuariosMante')->middleware('auth');
    Route::get('/estadisticas/oficinasMante','graficasController@oficinasMante')->middleware('auth');
    Route::get('/estadisticas/asignadosMante','graficasController@asignadosMante')->middleware('auth');
    
});

Route::group(['middleware' => ['standarUser']], function () {     

    //Rutas Tickets
    Route::get('/tickets/ver_tickets','ticketsController@list')->middleware('auth');
    Route::get('/tickets/nuevo_ticket','ticketsController@create')->middleware('auth');
    Route::post('/tickets/guardar','ticketsController@save')->middleware('auth');
    Route::get('/tickets/ver/{id}','ticketsController@see')->middleware('auth');
    Route::get('/tickets/ver/notificacion/{id}/{noti}','ticketsController@notificacion')->middleware('auth');
    Route::get('/tickets/notificaciones','ticketsController@notificaciones')->middleware('auth');
    //Route::get('/tickets/notificar/{id}','ticketsController@notificacion2')->middleware('auth');
    Route::get('/tickets/editar/{id}','ticketsController@edit')->middleware('auth');
    Route::post('/tickets/actualizar','ticketsController@update')->middleware('auth');
    Route::get('/tickets/borrar/{id}','ticketsController@delete')->middleware('auth');
    Route::post('/tickets/asignar','ticketsController@asignaciones')->middleware('auth');
    Route::get('/tickets/cerrar/{id}','ticketsController@cierre')->middleware('auth');
    Route::get('/tickets/reabrir/{id}','ticketsController@reapertura')->middleware('auth');
    Route::post('/tickets/respuestas','ticketsController@response')->middleware('auth');

    Route::get('/usuarios/editar/{id}','usuariosController@edit')->middleware('auth');
    Route::post('/usuarios/actualizar','usuariosController@update')->middleware('auth');
    Route::get('/error/403','usuariosController@unauthorized')->middleware('auth');
});

Route::group(['middleware' => ['adminUser']], function(){

    //Rutas Equipos
    Route::get('/equipos/ver_equipos','equiposController@list')->middleware('auth');
    Route::get('/equipos/nuevo_equipo','equiposController@create')->middleware('auth');
    Route::post('/equipos/guardar','equiposController@save')->middleware('auth');
    Route::get('/equipos/editar/{id}','equiposController@edit')->middleware('auth');
    Route::post('/equipos/actualizar','equiposController@update')->middleware('auth');
    //Route::get('/equipos/detalles/{id}','equiposController@details')->middleware('auth');
    //Route::get('/equipos/borrar/{id}','equiposController@delete')->middleware('auth');
    Route::post('/equipos/borrar','equiposController@delete')->middleware('auth');
    Route::get('/equipos/hojaVida/{id}','equiposController@hojaVida')->middleware('auth');    


    //Rutas Oficinas
    Route::get('/oficinas/ver_oficinas','oficinasController@list')->middleware('auth');
    Route::get('/oficinas/nueva_oficina','oficinasController@create')->middleware('auth');
    Route::post('/oficinas/guardar','oficinasController@save')->middleware('auth');
    Route::get('/oficinas/editar/{id}','oficinasController@edit')->middleware('auth');
    Route::post('/oficinas/actualizar','oficinasController@update')->middleware('auth');
    Route::get('/oficinas/borrar/{id}','oficinasController@delete')->middleware('auth');


    //Rutas Subdirecciones
    Route::get('/subdirecciones/ver_subdirecciones','subdireccionesController@list')->middleware('auth');
    Route::get('/subdirecciones/nueva_subdireccion','subdireccionesController@create')->middleware('auth');
    Route::post('/subdirecciones/guardar','subdireccionesController@save')->middleware('auth');
    Route::get('/subdirecciones/editar/{id}','subdireccionesController@edit')->middleware('auth');
    Route::post('/subdirecciones/actualizar','subdireccionesController@update')->middleware('auth');
    Route::get('/subdirecciones/borrar/{id}','subdireccionesController@delete')->middleware('auth');


    //Rutas Coordinaciones
    Route::get('/coordinaciones/ver_coordinaciones','coordinacionesController@list')->middleware('auth');
    Route::get('/coordinaciones/nueva_coordinacion','coordinacionesController@create')->middleware('auth');
    Route::post('/coordinaciones/guardar','coordinacionesController@save')->middleware('auth');
    Route::get('/coordinaciones/editar/{id}','coordinacionesController@edit')->middleware('auth');
    Route::post('/coordinaciones/actualizar','coordinacionesController@update')->middleware('auth');
    Route::get('/coordinaciones/borrar/{id}','coordinacionesController@delete')->middleware('auth');


    //Rutas Servicios
    Route::get('/servicios/ver_servicios','serviciosController@list')->middleware('auth');
    Route::get('/servicios/nuevo_servicio','serviciosController@create')->middleware('auth');
    Route::post('/servicios/guardar','serviciosController@save')->middleware('auth');
    Route::get('/servicios/editar/{id}','serviciosController@edit')->middleware('auth');
    Route::post('/servicios/actualizar','serviciosController@update')->middleware('auth');
    Route::get('/servicios/borrar/{id}','serviciosController@delete')->middleware('auth');


    //Rutas Antivirus
    Route::get('/antivirus/ver_antivirus','antivirusController@list')->middleware('auth');
    Route::get('/antivirus/nuevo_antivirus','antivirusController@create')->middleware('auth');
    Route::post('/antivirus/guardar','antivirusController@save')->middleware('auth');
    Route::get('/antivirus/editar/{id}','antivirusController@edit')->middleware('auth');
    Route::post('/antivirus/actualizar','antivirusController@update')->middleware('auth');
    Route::get('/antivirus/borrar/{id}','antivirusController@delete')->middleware('auth');


    //Rutas Marcas
    Route::get('/marcas/ver_marcas','marcasController@list')->middleware('auth');
    Route::get('/marcas/nueva_marca','marcasController@create')->middleware('auth');
    Route::post('/marcas/guardar','marcasController@save')->middleware('auth');
    Route::get('/marcas/editar/{id}','marcasController@edit')->middleware('auth');
    Route::post('/marcas/actualizar','marcasController@update')->middleware('auth');
    Route::get('/marcas/borrar/{id}','marcasController@delete')->middleware('auth');


    //Rutas Sistemas
    Route::get('/sistemas/ver_sistemas','sistemasController@list')->middleware('auth');
    Route::get('/sistemas/nuevo_sistema','sistemasController@create')->middleware('auth');
    Route::post('/sistemas/guardar','sistemasController@save')->middleware('auth');
    Route::get('/sistemas/editar/{id}','sistemasController@edit')->middleware('auth');
    Route::post('/sistemas/actualizar','sistemasController@update')->middleware('auth');
    Route::get('/sistemas/borrar/{id}','sistemasController@delete')->middleware('auth');


    //Rutas Tipos
    Route::get('/tipos/ver_tipos','tiposController@list')->middleware('auth');
    Route::get('/tipos/nuevo_tipo','tiposController@create')->middleware('auth');
    Route::post('/tipos/guardar','tiposController@save')->middleware('auth');
    Route::get('/tipos/editar/{id}','tiposController@edit')->middleware('auth');
    Route::post('/tipos/actualizar','tiposController@update')->middleware('auth');
    Route::get('/tipos/borrar/{id}','tiposController@delete')->middleware('auth');


    //Rutas Suites
    Route::get('/suite/ver_suite','suiteController@list')->middleware('auth');
    Route::get('/suite/nueva_suite','suiteController@create')->middleware('auth');
    Route::post('/suite/guardar','suiteController@save')->middleware('auth');
    Route::get('/suite/editar/{id}','suiteController@edit')->middleware('auth');
    Route::post('/suite/actualizar','suiteController@update')->middleware('auth');
    Route::get('/suite/borrar/{id}','suiteController@delete')->middleware('auth');


    //Rutas Softwares
    Route::get('/softwares/ver_softwares','softwaresController@list')->middleware('auth');
    Route::get('/softwares/nuevo_software','softwaresController@create')->middleware('auth');
    Route::post('/softwares/guardar','softwaresController@save')->middleware('auth');
    Route::get('/softwares/editar/{id}','softwaresController@edit')->middleware('auth');
    Route::post('/softwares/actualizar','softwaresController@update')->middleware('auth');
    Route::get('/softwares/borrar/{id}','softwaresController@delete')->middleware('auth');  

    //Rutas Mantenimientos
    Route::get('/mantenimientos/ver_mantenimientos','mantenimientosController@list')->middleware('auth');
    Route::get('/mantenimientos/nuevo_mantenimiento','mantenimientosController@create')->middleware('auth');
    Route::get('/mantenimientos/equipos','equiposController@obtenerEquipos')->middleware('auth');
    Route::post('/mantenimientos/guardar','mantenimientosController@store')->middleware('auth');
    Route::get('/mantenimientos/editar/{id}','mantenimientosController@edit')->middleware('auth');
    Route::post('/mantenimientos/actualizar','mantenimientosController@update')->middleware('auth');
    Route::get('/mantenimientos/hv/{id}','mantenimientosController@hv')->middleware('auth');
    Route::post('/mantenimientos/fprogramada','mantenimientosController@fprogramada')->middleware('auth');


    // //Rutas Tickets
    // Route::get('/tickets/ver_tickets','ticketsController@list')->middleware('auth');
    // Route::get('/tickets/nuevo_ticket','ticketsController@create')->middleware('auth');
    // Route::post('/tickets/guardar','ticketsController@save')->middleware('auth');
    // Route::get('/tickets/ver/{id}','ticketsController@see')->middleware('auth');
    // Route::get('/tickets/editar/{id}','ticketsController@edit')->middleware('auth');
    // Route::post('/tickets/actualizar','ticketsController@update')->middleware('auth');
    // Route::get('/tickets/borrar/{id}','ticketsController@delete')->middleware('auth');
});