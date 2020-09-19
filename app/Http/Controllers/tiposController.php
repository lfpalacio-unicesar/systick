<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tiposEquipos;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class tiposController extends Controller
{
    public function list(){
        
        $tipos = tiposEquipos::get();

        return view('otros/tipos/ver_tipos',compact('tipos'));
    }

    public function create(){
        return view('otros/tipos/nuevo_tipo');
    }

    public function save(Request $request){

        $this->validate($request,[
            'nombre'=>'unique:tiposequipos',
        ],[
            'nombre.unique'=>'Tipo duplicado, este tipo de equipo ya existe, por favor cambie el nombre del tipo de equipo.',
        ]);

        $tipo = new tiposEquipos;
        $tipo->fill($request->all());
        $tipo->save();

        // funcion bitacora
        $this->bitacoraTipo(1,$tipo->nombre);

        return redirect()->action('tiposController@list')->with('status','Tipo Equipo '.$request->nombre.' almacenado correctamente!');
    }

    public function edit($id){      

        $tipo = tiposEquipos::find($id);
        return view('otros/tipos/editar_tipo',compact('tipo'));
    }

    public function update(Request $request){

        $this->validate($request,[
            'nombre'=>'unique:tiposequipos',
        ],[
            'nombre.unique'=>'Tipo duplicado, este tipo de equipo ya existe, por favor cambie el nombre del tipo de equipo.',
        ]);

        $tipo = tiposEquipos::find($request->id);
        $antes = $tipo->nombre;
        $tipo->nombre = $request->nombre;
        $tipo->save();

        // funcion bitacora
        $this->bitacoraTipo(2,$tipo->nombre);

        return redirect()->action('tiposController@list')->with('status','Tipo Equipo '.$antes.' actualizado a '.$request->nombre.' correctamente!');
    }

    public function delete($id){
        

        $tipo = tiposEquipos::find($id);

        try{
            
            $nom_tipo = $tipo->nombre;       
            $tipo->delete();
            // funcion bitacora
            $this->bitacoraTipo(3,$nom_tipo);

        }catch(\Illuminate\Database\QueryException $e){
            
            return redirect()->action('tiposController@list')->with('status2','El Tipo Equipo: <b>'.$nom_tipo.'</b> no se puede eliminar porque se encuentra asociado a un Equipo.');
        
        }     

        return redirect()->action('tiposController@list')->with('status','Tipo Equipo: '.$nom_tipo.' eliminado correctamente!');
    }

    public function bitacoraTipo($bandera, $tipo){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado el tipo de equipo con nombre <b>'.$tipo.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado el tipo de equipo con nombre <b>'.$tipo.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado el tipo de equipo con nombre <b>'.$tipo.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
