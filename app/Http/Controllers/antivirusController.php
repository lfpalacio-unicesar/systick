<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;
use App\Antivirus;

class antivirusController extends Controller
{
    public function list(){

        $anti = Antivirus::get();
        return view('otros/antivirus/ver_antivirus',compact('anti'));
    }

    public function create(){

        return view('otros/antivirus/nuevo_antivirus');
    }

    public function save(Request $request){

        //validación antivirus
        $this->validate($request,[
            'nombre'=>'unique:antivirus',
        ],[
            'nombre.unique'=>'Antivirus duplicado, este antivirus ya existe, por favor cambie el nombre del antivirus.',
        ]);

        $anti = new Antivirus;
        $anti->fill($request->all());
        $anti->save();

        // funcion bitacora
        $this->bitacoraAntivirus(1,$anti->nombre);

        return redirect()->action('antivirusController@list')->with('status','Antivirus almacenado correctamente!');
    }

    public function edit($id){

        $anti = Antivirus::find($id);        
        return view('otros/antivirus/editar_antivirus',compact('anti'));
    }

    public function update(Request $request){

        //validación antivirus
        $this->validate($request,[
            'nombre'=>'unique:antivirus',
        ],[
            'nombre.unique'=>'Antivirus duplicado, este antivirus ya existe, por favor cambie el nombre del antivirus.',
        ]);

        $anti = Antivirus::find($request->id);
        $anti->nombre = $request->nombre;
        $anti->save();

        // funcion bitacora
        $this->bitacoraAntivirus(2,$anti->nombre);

        return redirect()->action('antivirusController@list')->with('status','Antivirus actualizado correctemente!');
    }

    public function delete($id){

        $anti = Antivirus::find($id);                

        try{
            
            // funcion bitacora
            $nom_anti = $anti->nombre;
            $anti->delete();
            $this->bitacoraAntivirus(3,$nom_anti);

        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->action('antivirusController@list')->with('status2','El Antivirus <b>'.$nom_anti .'</b> no se puede eliminar porque se encuentra asociado a un equipo.');
        }
        

        return redirect()->action('antivirusController@list')->with('status','Antivirus eliminado correctamente!');
    }

    public function bitacoraAntivirus($bandera, $antivirus){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado el antivirus con nombre <b>'.$antivirus.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado el antivirus con nombre <b>'.$antivirus.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha eliminado el antivirus con nombre <b>'.$antivirus.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
