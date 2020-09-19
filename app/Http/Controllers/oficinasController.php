<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficinas;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class oficinasController extends Controller
{
    public function list(){
        $oficinas = Oficinas::get();
        return view('oficinas/ver_oficina',compact('oficinas'));
    }
    
    public function create(){
        return view('oficinas/nueva_oficina');
    }

    public function save(Request $request){
        $oficina = new Oficinas;        
        
        if($request->tipo == 0){
            $oficina->nombre = 'SUB_'.mb_strtoupper($request->nombre);
        }else{
            $oficina->nombre = 'COORD_'.mb_strtoupper($request->nombre);
        }
        $oficina->tipo = $request->tipo;
        
        // validacion del nombre de la oficina
        $this->validate($request,[
            'nombre'=>'unique:oficinas'
        ],[
            'nombre.unique'=>'Nombre de oficina duplicado, por favor intente con un nombre diferente.',
        ]);
        $oficina->save();

        // función bitacora
        $this->bitacoraOficina(1,$oficina->nombre);

        return redirect()->action('oficinasController@list')->with('status','Oficina almacenada satisfactoriamente!');
    }

    public function edit($id){
        $oficina = Oficinas::find($id);
        return view('oficinas/editar_oficina',compact('oficina')); 
    }

    public function update(Request $request){        
        $oficina = Oficinas::find($request->id);

        if($request->tipo ==0){
            $sub = substr($request->nombre,0,4);
            if($sub === 'SUB_'){
                $oficina->nombre = $request->nombre;
            }else{
                $oficina->nombre = 'SUB_'.mb_strtoupper($request->nombre);
            }            
        }else{
            $sub = substr($request->nombre,0,6);
            if($sub === 'COORD_'){
                $oficina->nombre = $request->nombre;
            }else{
                $oficina->nombre = 'COORD_'.mb_strtoupper($request->nombre);
            }            
        }
        $oficina->tipo = $request->tipo;

        // validacion del nombre de la oficina
        $this->validate($request,[
            'nombre'=>'unique:oficinas'
        ],[
            'nombre.unique'=>'Nombre de oficina duplicado, por favor intente con un nombre diferente.',
        ]);


        $oficina->save();

        // función bitacora
        $this->bitacoraOficina(2,$oficina->nombre);

        return redirect()->action('oficinasController@list')->with('status','Oficina actualizada satisfactoriamente!');
    }

    public function delete($id){
        $oficina = Oficinas::find($id);
        
        try{

            $nom_oficina = $oficina->nombre;
            $oficina->delete();
            // función bitacora
            $this->bitacoraOficina(3,$nom_oficina);

        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->action('oficinasController@list')->with('status2','La Oficina <b>'.$nom_oficina.'</b> no se puede eliminar porque se encuentra asociada a un equipo o usuario.');
        }       

        return redirect()->action('oficinasController@list')->with('status','Oficina eliminada satisfactoriamente!');
    }

    public function bitacoraOficina($bandera, $oficina){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado la oficina con nombre <b>'.$oficina.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado la oficina con nombre <b>'.$oficina.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado la oficina con nombre <b>'.$oficina.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
