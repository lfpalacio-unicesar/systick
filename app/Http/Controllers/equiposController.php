<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipos;
use App\tiposEquipos;
use App\Marcas;
use App\Sistemas;
use App\Antivirus;
use App\Softwares;
use App\Suite;
use App\Oficinas;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\Mantenimientos;
use App\softwareEquipoMantenimiento;
use Mpdf\Mpdf;

class equiposController extends Controller
{
    //
    public function list(){
        $equipos = Equipos::get();
        return view('equipos/ver_equipos',compact('equipos'));
    }

    public function create(){
        $tipos = tiposEquipos::get();
        $marcas = Marcas::get();
        $sistemas = Sistemas::get();
        $antivirus = Antivirus::get();
        $softwares = Softwares::get();
        $suites = Suite::get();
        $oficinas = Oficinas::get();
        $usuarios = User::get();
        return view('equipos/nuevo_equipo',compact('tipos','marcas','sistemas','antivirus','softwares','suites','oficinas','usuarios'));
    }

    public function save(Request $request){
        //dd($request);
        // Validación del sticker
        $this->validate($request,[
            'sticker'=>'unique:equipos',
        ],[
            'sticker.unique'=>'Sticker interno duplicado, este debe ser unico',
        ]);

        
        if( isset($request->finstalacion) ){
            if($request->fcompra > $request->finstalacion){
                return redirect()->action('equiposController@create')->with('status','La fecha de <b>instalación</b> debe ser igual o posterior a la fecha de <b>compra</b>');
            }
        }
        

        $equipo = new Equipos;
        $equipo->fill($request->all());
        $equipo->save();
        //almacena en la tabla pivot software_equipo los registros almacenados en el arreglo softwares, este se debe realizar luego de almacenar el equipo 
        $equipo->softwares()->attach($request->softwares);

        //funcion bitacora
        $this->bitacoraEquipo(1,$request->sticker);
        
        return redirect()->action('equiposController@list')->with('status','Equipo almacenado correctamente!');
    }

    public function edit($id){
        $equipo = Equipos::find($id);
        $tipos = tiposEquipos::get();
        $marcas = Marcas::get();
        $sistemas = Sistemas::get();
        $antivirus = Antivirus::get();
        $softwares = Softwares::get();
        $suites = Suite::get();
        $oficinas = Oficinas::get();
        $softwares2 = $equipo->softwares;
        $usuarios = User::get();           
        
        return view('equipos/editar_equipo',compact('equipo','tipos','marcas','sistemas','antivirus','softwares','suites','oficinas','softwares2','usuarios'));         
    }

    public function update(Request $request){

        // Validación del sticker
        $this->validate($request,[
            'sticker'=>'unique:equipos',
        ],[
            'sticker.unique'=>'Sticker interno duplicado, este debe ser unico',
        ]);        

        $equipo = Equipos::find($request->id);

        if( isset($request->finstalacion) ){
            if($equipo->fcompra > $request->finstalacion){
                return redirect()->action('equiposController@list')->with('status2','La fecha de <b>instalación</b> debe ser igual o posterior a la fecha de <b>compra</b>');
            }
        }

        $equipo->fill($request->all());
        $equipo->save();
        $equipo->softwares()->sync($request->softwares);

        // funcion bitacora
        $this->bitacoraEquipo(2,$equipo->sticker);

        return redirect()->action('equiposController@list')->with('status','Equipo actualizado correctamente!');
        
    }    

    public function obtenerEquipos(){
        $equipos = Equipos::select("sticker")->get();
        return response()->json($equipos);
        //return $equipos;
        //return '{"suggestions":["Juan","Miguel","Alfonso"]}';
        //echo '["Juan","Miguel","Alfonso"]';
    }

    public function delete(Request $request){
        //este no elimina, en realidad realiza dar de baja y para esto pide una fecha, un motivo de baja y actualiza el estado del equipo
        //dd($request);
        $equipo = Equipos::find($request->id2);
        $equipo->fill($request->all());
        $equipo->save();

        // funcion bitacora
        $this->bitacoraEquipo(3,$equipo->sticker);

        return redirect()->action('equiposController@list')->with('status','Equipo descartado correctamente!');
    }

    public function hojaVida($id){
        
        //id del equipo
        $mantenimientos = Mantenimientos::where('equipo_id',$id)->latest()->get();
        $cantidad_man =  Mantenimientos::where('equipo_id',$id)->count();
        
        $equipo = Equipos::find($id);
        $baja = $equipo->estado;
        

        //se crea el pdf
        $pdf = new Mpdf();

            foreach ($mantenimientos as $i => $man) {                
            
                //debo iterar para intentar hacer varias paginas, debe iterar son los mantenimientos
                $softEquipoMante = softwareEquipoMantenimiento::where('equipo_id',$id)->where('mantenimiento_id',$man->id)->get();
                
                //calculo el # de registros de software que tiene el equipo
                $cantidad = $softEquipoMante->count();        
                
                //define vista a mostrar                
                $vista = view('mantenimientos.hoja_vida',compact('man','softEquipoMante','cantidad'))->render();  
                $pdf->allow_charset_conversion = true;
                $pdf->charset_in = 'iso-8859-4';                      
                $pdf->setFooter('{PAGENO}');


                //intento meter marca de agua
                if($baja != 1){
                    $pdf->SetWatermarkText('DADO DE BAJA');
                    $pdf->watermark_font = 'arial';
                    // $pdf->watermark_font_color = 'red';
                    // $pdf->watermarkTextAlpha = 0.1; 
                    $pdf->showWatermarkText = true;
                }

                $pdf->WriteHTML($vista);
                $pdf->SetDisplayMode('fullpage');               

                
                
                /*valido que el indice sea distinto a la cantidad de # de mantenimientos, esto para que me agregue las paginas 
                adicionales, cuando el indice iguale a la cantidad de registos, no agrego mas paginas para no generar paginas basura*/

                if($i != $cantidad_man-1){                    
                    $pdf->AddPage();
                }
            
            }
            
        //creo que esto debe quedar fuera del foreach
        $pdf->Output('Historial mantenimientos equipo #'.$id.'.pdf','D');
    }

    public function bitacoraEquipo($bandera, $equipo){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado el equipo con # de sticker <b>'.$equipo.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado el equipo con # de sticker <b>'.$equipo.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha dado de baja el equipo con # de sticker <b>'.$equipo.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
