<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipos;
use App\Mantenimientos;
use App\Softwares;
use App\softwareEquipoMantenimiento;
use Validator;
use Mpdf\Mpdf;
use Auth;

class mantenimientosController extends Controller
{
    public function list(){

        $mantenimiento = Mantenimientos::latest()->get();
        return view('mantenimientos/ver_mantenimientos',compact('mantenimiento'));
    }

    public function create(){

        $equipo = Equipos::get();
        return view('mantenimientos/nuevo_mantenimiento',compact('equipo'));
    }

    public function hv($id){
        
        $man = Mantenimientos::find($id);
        $softEquipoMante = softwareEquipoMantenimiento::where('equipo_id',$man->equipo_id)->where('mantenimiento_id',$id)->get();
        
        //calculo el # de registros de software que tiene el equipo
        $cantidad = $softEquipoMante->count();        
          
        //define vista a mostrar
        $vista = view('mantenimientos.hoja_vida',compact('man','softEquipoMante','cantidad'))->render();
        //se crea el pdf
        $pdf = new Mpdf();
        $pdf->allow_charset_conversion = true;
        $pdf->charset_in = 'iso-8859-4';        
        $pdf->setFooter('{PAGENO}');
        $pdf->WriteHTML($vista);
        $pdf->SetDisplayMode('fullpage');
        $pdf->Output('Evidencia mantenimiento # '.$man->id.'.pdf','D');
    }

    public function fprogramada (Request $request){
        
        $mantenimiento = Mantenimientos::find($request->id);
        $mantenimiento->fprogramada = $request->fprogramada;
        $mantenimiento->save();
        return redirect()->action('mantenimientosController@list')->with('status','Fecha mantenimiento programado actualizada correctamente!');
    }

    public function store(Request $request){

        //valido las fechas de ingreso y la de entrega
        if(isset($request->fentrega)){
            if($request->fentrega < $request->fingreso){                
                return redirect()->action('mantenimientosController@create')->with('status2','La fecha de entrega debe ser igual o posterior a la fecha de ingreso')->withInput($request->Input());
            }
        }

        //obtengo los datos del equipo
        $equipo = Equipos::find($request->equipo_id);
        
        //objeto mantenimiento
        $mante = new Mantenimientos();        

        //datos mantenimiento
        $mante->tipo = $request->tipo;
        $mante->estado = $request->estado;
        $mante->acciones = $request->acciones;
        $mante->conclusiones = $request->conclusiones;
        $mante->equipo_id = $request->equipo_id;
        $mante->fingreso = $request->fingreso;
        $mante->fprogramada = $request->fprogramada;
        $mante->fentrega = $request->fentrega;
        $mante->responsable = Auth::user()->id;
        //datos equipo
        $mante->tipo_id = $equipo->tipo_id;
        $mante->critico = $equipo->critico;
        $mante->oficina_id = $equipo->oficina_id;
        $mante->marca_id = $equipo->marca_id;
        $mante->modelo = $equipo->modelo;
        $mante->sticker = $equipo->sticker;
        $mante->sticker_monitor = $equipo->sticker_monitor;
        $mante->sticker_teclado = $equipo->sticker_teclado;
        $mante->sticker_mouse = $equipo->sticker_mouse;
        $mante->procesador = $equipo->procesador;
        $mante->ram = $equipo->ram;
        $mante->almacenamiento = $equipo->almacenamiento;
        $mante->sistema_id = $equipo->sistema_id;
        $mante->estadoSistema = $equipo->estadoSistema;
        $mante->suite_id = $equipo->suite_id;
        $mante->estadoSuite = $equipo->estadoSuite;
        $mante->antivirus_id = $equipo->antivirus_id;
        $mante->estadoAntivirus = $equipo->estadoAntivirus;
        $mante->fcompra = $equipo->fcompra;
        $mante->finstalacion = $equipo->finstalacion;
        $mante->fbaja = $equipo->fbaja;
        $mante->estado_equipo = $equipo->estado;
        $mante->motivo_baja = $equipo->motivo_baja;
        $mante->nombre = $equipo->nombre;
        $mante->ip = $equipo->ip;
        $mante->mac = $equipo->mac;
        $mante->asignado = $equipo->asignado;
        $mante->usuario_id = $equipo->usuario_id;
        

        $mante->save();
        $ultimo_mante = $mante->get()->last();
        //dd($ultimo_mante->id); 

        //datos tabla intersecta
         //busco los id de los softwares que estan asociados al equipo para luego almacenaeros

         //debo validar aqui porque es posible que no tengan equipos asociados
         

         $software = $equipo->softwares()->get();
         foreach($software as $soft){
             $softEquipoMante = new softwareEquipoMantenimiento();   
             $softEquipoMante->equipo_id = $request->equipo_id;
             $softEquipoMante->software_id = $soft->id;
             $softEquipoMante->mantenimiento_id = $ultimo_mante->id;
             $softEquipoMante->save();
         }        
        
        return redirect()->action('mantenimientosController@list')->with('status','Mantenimiento registrado correctamente!');        
    }

    public function edit($id){
        
        $equipo = Equipos::get();
        // dd($equipo);
        $mante = Mantenimientos::find($id); 
        
        return view('mantenimientos.editar_mantenimiento', compact('mante','equipo'));
    } 

    public function update(Request $request){
        
        $mante = Mantenimientos::find($request->id);
        
        if(isset($request->fentrega)){            
             if($request->fentrega != null){                
                if ($mante->fingreso > $request->fentrega){
                    // return redirect()->action('mantenimientosController@list')->with('status2','La fecha de entrega debe ser igual o posterior a la de ingreso del equipo al mantenimiento.')->withInput($request->Input());
                    return redirect()->back()->with('status2','La fecha de entrega debe ser igual o posterior a la de ingreso del equipo al mantenimiento.')->withInput($request->Input());
                }
            }
        }        

        $mante->fill($request->all());
        $mante->save();

        return redirect()->action('mantenimientosController@list')->with('status','Mantenimiento actualizado correctamente!');
    }
}
