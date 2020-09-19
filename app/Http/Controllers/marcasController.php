<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marcas;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class marcasController extends Controller
{
    public function list(){

        $marcas = Marcas::get();
        return view('otros/marcas/ver_marcas', compact('marcas'));
    }

    public function create(){

        return view('otros/marcas/nueva_marca');
    }

    public function save(Request $request){

        //validación marcas
        $this->validate($request,[
            'nombre'=>'unique:marcas',
        ],[
            'nombre.unique'=>'Marca duplicada, esta marca ya existe, por favor cambie el nombre de la marca del equipo.',
        ]);
        
        $marca = new Marcas;
        $marca->fill($request->all());
        $marca->save();

        // funcion bitacora
        $this->bitacoraMarca(1,$marca->nombre);
        
        return redirect()->action('marcasController@list')->with('status','Marca Equipo almacenada exitosamente!');
    }

    public function edit($id){

        $marca = Marcas::find($id);
        return view('otros/marcas/editar_marca',compact('marca'));
    }

    public function update(Request $request){

        //validación marcas
        $this->validate($request,[
            'nombre'=>'unique:marcas',
        ],[
            'nombre.unique'=>'Marca duplicada, esta marca ya existe, por favor cambie el nombre de la marca del equipo.',
        ]);

        $marca = Marcas::find($request->id);
        $marca->nombre = $request->nombre;
        $marca->save();

        // funcion bitacora
        $this->bitacoraMarca(2,$marca->nombre);

        return redirect()->action('marcasController@list')->with('status','Marca Equipo actualizada exitosamente!');
    }

    public function delete($id){
        
        $marca = Marcas::find($id);

        
        try{

            // funcion bitacora
            $nom_marca = $marca->nombre;
            $marca->delete();
            $this->bitacoraMarca(3,$nom_marca);

        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->action('marcasController@list')->with('status2','La Marca <b>'.$nom_marca.'</b> no se puede eliminar porque se encuentra asociada a un equipo.');
        }        

        return redirect()->action('marcasController@list')->with('status','Marca Equipo eliminada satisfactoriamente!');
    }

    public function bitacoraMarca($bandera, $marca){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado la marca con nombre <b>'.$marca.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado la marca con nombre <b>'.$marca.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado la marca con nombre <b>'.$marca.'</b> de forma correcta.';
        }

        $bitacora->save();
    }

}
