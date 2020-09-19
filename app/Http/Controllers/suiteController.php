<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suite;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class suiteController extends Controller
{
    public function list(){
        $suite = Suite::get(); 
        return view('otros/suite/ver_suite',compact('suite'));
    }

    public function create(){
        return view('otros/suite/nueva_suite');
    }

    public function save(Request $request){     
        
        // validación suite
        $this->validate($request,[
            'nombre'=>'unique:suite',    
        ],[
            'nombre.unique'=>'Suite duplicada, esta suite ya existe, por favor cambie el nombre de la suite.',
        ]);
        
        $suite = new Suite;
        $suite->fill($request->all());
        $suite->save();

        // funcion bitacora
        $this->bitacoraSuite(1,$suite->nombre);

        return redirect()->action('suiteController@list')->with('status','Suite almacenada de manera exitosa!');
    }

    public function edit($id){
        $suite = Suite::find($id);
        return view('otros/suite/editar_suite',compact('suite'));
    }

    public function update(Request $request){

        // validación suite
        $this->validate($request,[
            'nombre'=>'unique:suite',    
        ],[
            'nombre.unique'=>'Suite duplicada, esta suite ya existe, por favor cambie el nombre de la suite.',
        ]);

        $suite = Suite::find($request->id);
        $suite->nombre = $request->nombre;
        $suite->save();

        // funcion bitacora
        $this->bitacoraSuite(2,$suite->nombre);

        return redirect()->action('suiteController@list')->with('status','Suite actualizada satisfactoriamente!');
    }

    public function delete($id){
        $suite=Suite::find($id);

        try{
            
            $nom_suite = $suite->nombre;
            $suite->delete();
            // funcion bitacora
            $this->bitacoraSuite(3,$nom_suite);

        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->action('suiteController@list')->with('status2','La Suite <b>'.$nom_suite.'</b> no se puede eliminar porque se encuentra asociada a un Equipo.');

        }
        
        return redirect()->action('suiteController@list')->with('status','Suite eliminada satisfactoriamente!');
    }

    public function bitacoraSuite($bandera, $suit){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado la suite con nombre <b>'.$suit.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado la suite con nombre <b>'.$suit.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado la suite con nombre <b>'.$suit.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
