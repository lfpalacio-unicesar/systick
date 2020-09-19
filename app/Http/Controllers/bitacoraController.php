<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;


class bitacoraController extends Controller
{
    public function list(Request $request){
        $bitacora=null;
        return view ('otros.bitacora.listar_bitacora',compact('bitacora'));
    }

    public function search(Request $request){
        
        $us = Auth::user();
        $bitacora = Bitacora::Buscar($request)->get();
        //$bitacora->sortByDesc('created_at');

        return view ('otros.bitacora.listar_bitacora',compact('bitacora','us'))->with($request->all());
    }
}
