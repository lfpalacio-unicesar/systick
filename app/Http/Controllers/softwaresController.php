<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Softwares;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class softwaresController extends Controller
{
    public function list(){
        $softwares = Softwares::get(); 
        return view('otros/softwares/ver_softwares',compact('softwares'));
    }

    public function create(){
        return view('otros/softwares/nuevo_software');
    }

    public function save(Request $request){     
        
        //validacion software
        $this->validate($request,[
            'nombre'=>'unique:softwares',
        ],[
            'nombre.unique'=>'Software duplicado, este software ya existe, por favor cambie el nombre del software.',
        ]);

        $software = new Softwares;
        $software->fill($request->all());
        $software->save();

        // funcion bitacora
        $this->bitacoraSoftware(1,$software->nombre);

        return redirect()->action('softwaresController@list')->with('status','Software creado satisfactoriamente!');        
    }

    public function edit($id){
        $software = Softwares::find($id);
        return view('otros/softwares/editar_softwares',compact('software'));
    }

    public function update(Request $request){

        //validacion software
        $this->validate($request,[
            'nombre'=>'unique:softwares',
        ],[
            'nombre.unique'=>'Software duplicado, este software ya existe, por favor cambie el nombre del software.',
        ]);
        
        $software = Softwares::find($request->id);
        $software->nombre = $request->nombre;
        $software->save();

        // funcion bitacora
        $this->bitacoraSoftware(2,$software->nombre);

        return redirect()->action('softwaresController@list')->with('status','Software actualizado satisfactoriamente!');
    }

    public function delete ($id){
        $software = Softwares::find($id);

        try{

            $nom_soft = $software->nombre;
            $software->delete();
            // funcion bitacora
            $this->bitacoraSoftware(3,$nom_soft);

        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->action('softwaresController@list')->with('status2','El Software <b>'.$nom_soft.'</b> no se puede eliminar porque se encuentra asociado a un Equipo.');

        }        
        
        return redirect()->action('softwaresController@list')->with('status','Software eliminado satisfactoriamente!');
    }

    public function bitacoraSoftware($bandera, $soft){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado el software con nombre <b>'.$soft.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado el software con nombre <b>'.$soft.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado el software con nombre <b>'.$soft.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
