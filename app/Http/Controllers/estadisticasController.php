<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class estadisticasController extends Controller
{
    public function list(){
        //defino array de meses que usaré para los reportes por mes
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return view('estadisticas.estadisticas', compact('meses'));
    }

    public function listTickets(){
        //defino array de meses que usaré para los reportes por mes
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return view('estadisticas.tickets_report', compact('meses'));
    }

    public function listUsers(){
        //defino array de meses que usaré para los reportes por mes
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return view('estadisticas.usuarios_report', compact('meses'));
    }

    public function listOficinas(){
        //defino array de meses que usaré para los reportes por mes
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return view('estadisticas.oficinas_report', compact('meses'));
    }

    public function listMantenimientos(){
        //defino array de meses que usaré para los reportes por mes
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return view('estadisticas.mantenimientos_report', compact('meses'));
    }
}
