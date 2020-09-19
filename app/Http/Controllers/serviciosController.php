<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicios;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class serviciosController extends Controller
{
    public function list(){

        $servicios = Servicios::get();
        return view('servicios/ver_servicios', compact('servicios'));
    }

    public function create(){        
        return view('servicios/nuevo_servicio');
    }

    public function save(Request $request){

        // validación servicio
        $this->validate($request,[
            'nombre'=>'unique:servicios',
        ],[
            'nombre.unique'=>'Servicio duplicado, este servicio ya existe, por favor cambie el nombre del servicio.',
        ]);

        $servicio = new Servicios;
        $servicio->fill($request->all());
        $servicio->save();

        // funcion bitacora
        $this->bitacoraServicio(1,$servicio->nombre);

        return redirect()->action('serviciosController@list')->with('status','Servicio '. $request->nombre.' almacenado correctamente!');
    }

    public function edit($id){

        $servicio = Servicios::find($id);
        return view('servicios/editar_servicio', compact('servicio'));
    }

    public function update(Request $request){

        // validación servicio
        $this->validate($request,[
            'nombre'=>'unique:servicios',
        ],[
            'nombre.unique'=>'Servicio duplicado, este servicio ya existe, por favor cambie el nombre del servicio.',
        ]);

        $servicio = Servicios::find($request->id);
        
        $antes = $servicio->nombre;
        $servicio->nombre = $request->nombre;
        $servicio->save();

        // funcion bitacora
        $this->bitacoraServicio(2,$servicio->nombre);

        return redirect()->action('serviciosController@list')->with('status','Servicio '.$antes.' actualizado a'.$request->nombre.' correctamente!');
    }

    public function delete($id){        

        $servicio = Servicios::find($id);

        if($id <= 3){
            return redirect()->action('serviciosController@list')->with('status3','El Tipo de servicio <b>'.$servicio->nombre.'</b> no se puede eliminar porque es un servicio estandar del sistema!');
        }

        try{

            $nom_servicio = $servicio->nombre;
            $servicio->delete();
            //funcion bitacora 
            $this->bitacoraServicio(3,$nom_servicio);

        }catch(\Illuminate\Database\QueryException $e){
            
            return redirect()->action('serviciosController@list')->with('status2','El Servicio <b>'.$nom_servicio.'</b> no se puede eliminar porque se encuentra asociado a un Ticket.');
        
        }    

        return redirect()->action('serviciosController@list')->with('status','Servicio '.$nom_servicio.' eliminado correctamente!');
    }

    public function bitacoraServicio($bandera, $servicio){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado el servicio con nombre <b>'.$servicio.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado el servicio con nombre <b>'.$servicio.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado el servicio con nombre <b>'.$servicio.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
