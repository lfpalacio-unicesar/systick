<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sistemas;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class sistemasController extends Controller
{
    public function list(){

        $sistemas = Sistemas::get();         
        return view('otros/sistemas/ver_sistemas',compact('sistemas'));
    }

    public function create(){
        return view('otros/sistemas/nuevo_sistemas');
    }

    public function save(Request $request){

        // validacion sistemas
        $this->validate($request,[
            'nombre'=>'unique:sistemas',
        ],[
            'nombre.unique'=>'Sistema duplicado, este sistema ya existe, por favor cambie el nombre del sistema.',
        ]);
        
        $sistema = new Sistemas;
        $sistema->fill($request->all());
        $sistema->save();

        // funcion bitacora
        $this->bitacoraSistema(1,$sistema->nombre);

        return redirect()->action('sistemasController@list')->with('status','Sistema Operativo almacenado exitosamente!');
    }

    public function edit($id){

        $sistema = Sistemas::find($id);
        return view('/otros/sistemas/editar_sistemas',compact('sistema','id'));
    }

    public function update(Request $request){

        // validacion sistemas
        $this->validate($request,[
            'nombre'=>'unique:sistemas',
        ],[
            'nombre.unique'=>'Sistema operativo duplicado, este sistema ya existe, por favor cambie el nombre.',
        ]);
        
        $sistema = Sistemas::find($request->id);
        $sistema->nombre = $request->nombre;
        $sistema->save();

        // funcion bitacora
        $this->bitacoraSistema(2,$sistema->nombre);

        return redirect()->action('sistemasController@list')->with('status','Sistema Operativo actualizado exitosamente!');
    }

    public function delete($id){

        $sistema = Sistemas::find($id);

        try{
            
            $nom_sistema = $sistema->nombre; 
            $sistema->delete();
            // funcion bitacora
            $this->bitacoraSistema(3,$nom_sistema);

        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->action('sistemasController@list')->with('status2','El Sistema Operativo <b>'.$nom_sistema.'</b> no se puede eliminar porque se encuentra asociado a un Equipo.');
        
        }        

        return redirect()->action('sistemasController@list')->with('status','Sistema Operativo eliminado exitosamente!');
    }

    public function bitacoraSistema($bandera, $sistemas){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado el sistema con nombre <b>'.$sistemas.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado el sistema con nombre <b>'.$sistemas.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado el sistema con nombre <b>'.$sistemas.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
