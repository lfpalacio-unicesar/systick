<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicios;
use App\tiposEquipos;
use App\Tickets;
use App\ArchivosTickets;
use App\Equipos;
use Auth;
use App\User;
use App\TicketsRespuestas;
use App\ArchivosRespuestasTickets;
use Mail;
use Validator;
use App\Notificaciones;


class ticketsController extends Controller
{
    public function list(){

        //condiciono los resultados según tipo de usuario
        if(Auth::user()->rol == 2){
            //el superadmin debe porder ver todos los tickets
            $tickets = Tickets::latest()->get();
        }elseif(Auth::user()->rol == 1){
            //el admin debe ver los tickets que tiene asignados.. de manera que debo validar frente a la tablas de asignaciones
            $tickets = Tickets::where('asignado',Auth::user()->id)->orWhere('user_id',Auth::user()->id)->latest()->get();
        }else{
            //el usuario standar solo debe ver los tickets que ha abierto con su usuario
            $tickets = Tickets::where('user_id',Auth::user()->id)->latest()->get();            
        }
        
        
        return view('tickets/ver_tickets', compact('tickets'));
    }

    public function create(){
        $servicios = Servicios::get();
        $tipos = tiposEquipos::get();
        $equipos = Equipos::get();
        return view('tickets/nuevo_ticket',compact('servicios','tipos','equipos'));
    }

    public function save(Request $request){        
        

        try{
            //entro a validar tamaño y tipos de archivos
            if($request->archivos != null){

                
                $files = $request->file('archivos');
                
                foreach ($files as $key => $file) {

                    $ext = $file->getClientOriginalExtension();
                    $size = $file->getClientSize()/1024;

                    switch ($ext) {
                        case 'jpg':
                            $opt = '1';
                            break;
                        case 'png':
                            $opt = '1';
                            break;
                        case 'bmp':
                            $opt = '1';
                            break;
                        case 'jpeg':
                            $opt = '1';
                            break;
                        case 'doc':
                            $opt = '1';
                            break;
                        case 'docx':
                            $opt = '1';
                            break;
                        case 'xls':
                            $opt = '1';
                            break;
                        case 'xlsx':
                            $opt = '1';
                            break;
                        case 'ppt':
                            $opt = '1';
                            break;
                        case 'pptx':
                            $opt = '1';
                            break;
                        case 'pdf':
                            $opt = '1';
                            break;
                        case 'rtf':
                            $opt = '1';
                            break;
                        case 'txt':
                            $opt = '1';
                            break;
                        default:
                            $opt = '0';
                    }
                    
                    //valido si me llega 0, es decir se cargo un formato no permitido y si el archivo pesa mas de 5.5MB
                    if($opt != 1 || $size >= 5500 || $size<=0){                    
                        return redirect()->action('ticketsController@create')->with('status2','Tipo o tamaño de archivo invalido: <br> - Solo se admiten archivos menores a 5MB <br> - Tipos de archivos soportados: jpeg, jpg, png, bmp, pdf, xlsx, xls, docx, doc, pptx, ppt, txt, rtf.')->withInput($request->Input());                    
                    }
                }        
            }
        }catch(\Exception $e){
            return redirect()->action('ticketsController@create')->with('status2','Tamaño de archivo muy grande')->withInput($request->Input());                    
        }
                      
        
        $ticket = new Tickets();
        $ticket->fill($request->all());
        $ticket->save();

        $ultimo_ticket = Tickets::all()->last();
                
        //valido la existencia de archivos en el formulario
        if($request->archivos != null){

            //paso los archivos traidos del formulario al array files para recorrerlo
            $files = $request->file('archivos');
            
            //recorro el arreglo de archivos
            foreach ($files as $file) {
                
                //creo instancia del modelo ArchivosTickets
                $archivo_ticket = new ArchivosTickets();

                //extaigo nombre de archivos, añado prefijos y tomo el id del ultimo ticket para asociarlo a los archivos
                $archivo_ticket->nombre = $file->getClientOriginalName();
                $archivo_ticket->ruta = str_replace(" ","_",substr(md5(uniqid(rand())),0,6).'_'.$file->getClientOriginalName());
                $archivo_ticket->ticket_id = $ultimo_ticket->id;
                
                //mueve los archivos al directorio
                $file->move(public_path('files/tickets'),$archivo_ticket->ruta);

                //guardo los archivos
                $archivo_ticket->save();
            }
        }

        //creo array data para poder pasar datos de relaciones eloquent a la vista del correo
        $data = array(
            'codigo'=>$ultimo_ticket->id,
            'tipo'=>$ultimo_ticket->servicios->nombre, 
            'titular'=>$ultimo_ticket->titular,
            'asunto'=>$ultimo_ticket->asunto,
            'descripcion'=>$ultimo_ticket->descripcion,
        );

        //busco los usuarios que sean superadmin para enviar el mail a cada uno de ellos y enviarles notificacion de nuevo ticket
        $users = User::where('rol',2)->get();

        //notificaciones a cada usuario superadmin
        foreach ($users as $user) {
            $noti = new Notificaciones();
            $noti->usuario_id = $user->id;
            $noti->mensaje = 'El usuario <b>'.$ultimo_ticket->usuarios->name.'</b> creó el ticket <b>#'.$ultimo_ticket->id.'</b> de tipo <b>'.$ultimo_ticket->servicios->nombre.'</b> con asunto <b>'.$ultimo_ticket->asunto.'</b>';      
            $noti->persona = $ultimo_ticket->titular;
            $noti->ticket_id = $ultimo_ticket->id;
            $noti->save();
        }

        
        //Envio de correo
        try {
            foreach ($users as $user) {
                Mail::send('emails.tickets', $data, function ($message) use ($request, $ultimo_ticket, $user) {                        
                    $message->to($user->email, $user->name);                
                    $message->subject('Notificación de creación Ticket # '.$ultimo_ticket->id);                            
                });    
            }    
        } catch (\Exception $e) {
            
            return redirect()->action('ticketsController@list')->with('status','Ticket con asunto: <b>'.$ultimo_ticket->asunto.'</b> almacenado exitosamente!')->with('status2','Falló envio de correo, por favor notificar al personal de sistemas.');
        }
        

        return redirect()->action('ticketsController@list')->with('status','Ticket con asunto: <b>'.$ultimo_ticket->asunto.'</b> almacenado exitosamente!');
    }

    public function response(Request $request){

        //dd($request);

        //entro a validar tamaño y tipos de archivos
        if($request->archivos != null){

            $files = $request->file('archivos');
            
            foreach ($files as $key => $file) {

                $ext = $file->getClientOriginalExtension();
                $size = $file->getClientSize()/1024;

                switch ($ext) {
                    case 'jpg':
                        $opt = '1';
                        break;
                    case 'png':
                        $opt = '1';
                        break;
                    case 'bmp':
                        $opt = '1';
                        break;
                    case 'jpeg':
                        $opt = '1';
                        break;
                    case 'doc':
                        $opt = '1';
                        break;
                    case 'docx':
                        $opt = '1';
                        break;
                    case 'xls':
                        $opt = '1';
                        break;
                    case 'xlsx':
                        $opt = '1';
                        break;
                    case 'ppt':
                        $opt = '1';
                        break;
                    case 'pptx':
                        $opt = '1';
                        break;
                    case 'pdf':
                        $opt = '1';
                        break;
                    case 'rtf':
                        $opt = '1';
                        break;
                    case 'txt':
                        $opt = '1';
                        break;
                    default:
                        $opt = '0';
                }
                
                //valido si me llega 0, es decir se cargo un formato no permitido y si el archivo pesa mas de 5.5MB
                if($opt != 1 || $size >= 5500 || $size<=0){                    
                    // return redirect()->action('ticketsController@create')->with('status2','Tipo o tamaño de archivo invalido: <br> - Solo se admiten archivos menores a 5MB <br> - Tipos de archivos soportados: jpeg, jpg, png, bmp, pdf, xlsx, xls, docx, doc, pptx, ppt, txt, rtf.')->withInput($request->Input());
                    return redirect()->back()->with('status3','Tipo o tamaño de archivo invalido: <br> - Solo se admiten archivos menores a 5MB <br> - Tipos de archivos soportados: jpeg, jpg, png, bmp, pdf, xlsx, xls, docx, doc, pptx, ppt, txt, rtf.')->withInput($request->Input());
                }
            }        
        }


        
        
        $respuesta = new TicketsRespuestas;
        $respuesta->fill($request->all());
        $respuesta->save();

        $users = User::where('rol',2)->get();

        //trabajo dinamica de notificacion respuesta.. debo validar quien contesta, si el usuario o el admin
        $ticket = Tickets::find($request->ticket_id);
        $noti = new Notificaciones(); //creo el objeto de notificaciones

        //valido si el usuario titular del ticket es el que contesta, de no ser asi entonces se asume que es el admin
        if($ticket->user_id == $request->usuario_id ){
            
            if($ticket->asignado != null){

                $noti->usuario_id = $ticket->asignado;
                $noti->mensaje = 'El usuario <b>'.$ticket->usuarios->name.'</b> ha respondido al ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b>';
                $noti->persona = $ticket->titular;
                $noti->ticket_id = $ticket->id;
                $noti->save();

            }else{

                foreach ($users as $user) {
                    $noti3 = new Notificaciones();
                    $noti3->usuario_id = $user->id;
                    $noti3->mensaje = 'El usuario <b>'.$ticket->usuarios->name.'</b> ha respondido al ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b>';
                    $noti3->persona = $ticket->titular;
                    $noti3->ticket_id = $ticket->id;
                    $noti3->save();
                }
            }           
            
        }else{

            $noti->usuario_id = $ticket->user_id;
            $noti->mensaje = 'Se ha dado respuesta a su ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b>';
            $noti->persona = Auth::user()->name;
            $noti->ticket_id = $ticket->id;
            $noti->save();
        }
        
        //almaceno notificación
        

        $utima_respuesta = TicketsRespuestas::all()->last();
        //valido la existencia de archivos en el formulario
        if($request->archivos != null){

            //paso los archivos traidos del formulario al array files para recorrerlo
            $files = $request->file('archivos');
            
            //recorro el arreglo de archivos
            foreach ($files as $file) {
                
                //creo instancia del modelo ArchivosTickets
                $archivo_respuesta_ticket = new ArchivosRespuestasTickets();

                //extaigo nombre de archivos, añado prefijos y tomo el id del ultimo ticket para asociarlo a los archivos
                $archivo_respuesta_ticket->nombre = $file->getClientOriginalName();
                $archivo_respuesta_ticket->ruta = str_replace(" ","_",substr(md5(uniqid(rand())),0,6).'_'.$file->getClientOriginalName());
                $archivo_respuesta_ticket->respuesta_id = $utima_respuesta->id;
                
                //mueve los archivos al directorio
                $file->move(public_path('files/respuestas'),$archivo_respuesta_ticket->ruta);

                //guardo los archivos
                $archivo_respuesta_ticket->save();
            }
        }

        return redirect()->back()->with('status','¡Respuesta registrada exitosamente!');
        //return redirect()->action('ticketsController@see')->with('id',$request->ticket_id);
        
    }

    public function see($id){
        //obtener url anterior en laravel
        //dd(redirect()->getUrlGenerator()->previous());

        $ticket = Tickets::find($id);
        $archivos = ArchivosTickets::where('ticket_id',$id)->get();
        $respuestas = TicketsRespuestas::where('ticket_id',$id)->get();
        $archivos_respuestas = ArchivosRespuestasTickets::all();
        //$archivosRespuestas = SEGUIR AQUI 
        
        //valído que el rol del usuario sea mayor a 0 para excluir el rol standar, pues a estos no se les debe asignar tickets.
        $usuarios = User::where('rol','>',0)->get();
        $rol = Auth::user()->rol;

        return view('tickets/ver_ticket',compact('ticket','usuarios','rol','archivos','respuestas','archivos_respuestas'));
    }

    public function notificacion($id,$noti){
        
        //obtener url anterior en laravel
        //dd(redirect()->getUrlGenerator()->previous());
        $notify = Notificaciones::find($noti);
        if($notify->visto == 0){
            $notify->visto = 1;
            $notify->save();
        }        

        $ticket = Tickets::find($id);
        $archivos = ArchivosTickets::where('ticket_id',$id)->get();
        $respuestas = TicketsRespuestas::where('ticket_id',$id)->get();
        $archivos_respuestas = ArchivosRespuestasTickets::all();
        //$archivosRespuestas = SEGUIR AQUI 
        
        //valído que el rol del usuario sea mayor a 0 para excluir el rol standar, pues a estos no se les debe asignar tickets.
        $usuarios = User::where('rol','>',0)->get();
        $rol = Auth::user()->rol;

        return view('tickets/ver_ticket',compact('ticket','usuarios','rol','archivos','respuestas','archivos_respuestas'));
    }

    public function notificaciones(){
        //$notificaciones = Notificaciones::where('usuario_id',Auth::user()->id)->latest()->get();
        $notificaciones = Notificaciones::where('usuario_id',Auth::user()->id)->orderBy('visto','DESC')->get();
        return view('tickets/notificaciones',compact('notificaciones'));
    }    

    public function asignaciones(Request $request){

        //almaceno el cambio de usuario asignado
        $ticket = Tickets::find($request->ticket_id);
        $usuario = User::find($request->asignado);
        
        //notificacion
        $noti = new Notificaciones();
        $noti->usuario_id = $usuario->id;
        
        //realizo validación para saber si el ticket se esta asignando por primera vez o se esta reasignando para personalizar los mensajes.
        if($ticket->asignado == null){
            $sw='Ticket asignado a ' .$usuario->name. ' exitosamente!';
            $sw2='asigna';
            $noti->mensaje = 'Se asigna el ticket <b>#'.$ticket->id.'</b> de tipo <b>'.$ticket->servicios->nombre.'</b> del titular <b>'.$ticket->titular.'</b> y asunto <b>'.$ticket->asunto.'</b>';
            
        }else{
            $sw='Ticket reasignado a '.$usuario->name.' exitosamente!';
            $sw2='reasigna';
            $noti->mensaje = 'Se reasigna el ticket <b>#'.$ticket->id.'</b> de tipo <b>'.$ticket->servicios->nombre.'</b> del titular <b>'.$ticket->titular.'</b> y asunto <b>'.$ticket->asunto.'</b>';

        }

        //guardo la notificacion
        $noti->persona = Auth::user()->name;
        $noti->ticket_id = $ticket->id;
        $noti->save();
        
        $ticket->asignado = $request->asignado;
        $ticket->estado_id = 2;
        $ticket->save();

        //almaceno en tabla intersecta el registro del nuevo asignado para llevar un historico de asignaciones por ticket
        $ticket->asignados()->attach($request->asignado,['created_at'=>date('Y-m-d H:i:s')]);

        //registro una respuesta al ticket de que este fue asignado
        $respuesta = new TicketsRespuestas();
        $respuesta->ticket_id = $ticket->id;
        $respuesta->usuario_id = Auth::user()->id;
        $respuesta->respuesta = 'El ticket se '.$sw2.' al usuario '.$usuario->name.' para brindar solución.';
        $respuesta->save();

        return redirect()->action('ticketsController@list')->with('status',$sw);        
    }

    public function cierre($id){
        
        //cambio el estado del ticket a cerrado
        $ticket = Tickets::find($id);
        $ticket->estado_id = 5;
        $ticket->save();

        $usuario = User::find(Auth::user()->id);

        //registro una respuesta avisando que el ticket ha sido cerrado y quien lo ha hecho        
        $respuesta = new TicketsRespuestas();
        $respuesta->ticket_id = $id;
        $respuesta->usuario_id = Auth::user()->id;
        $respuesta->respuesta = 'El ticket ha sido cerrado por el usuario '.$usuario->name.'.';
        $respuesta->save();        

        //trabajo dinamica de notificacion respuesta.. debo validar quien contesta, si el usuario o el admin        
        $noti = new Notificaciones(); //creo el objeto de notificaciones

        //valido si el usuario titular del ticket es el que cierra, de no ser asi entonces se asume que es el admin
        if($ticket->user_id == Auth::user()->id ){
            //el fallo se presenta al cerrar un ticket porque no ha sido asignado
            // otra manera de validar esto seria no permitir cerrar hasta que el ticket sea asignado. (esta fue la que se tomó)
            
            $noti->usuario_id = $ticket->asignado;
            $noti->mensaje = 'El usuario <b>'.$ticket->usuarios->name.'</b> ha <b>cerrado</b> el ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b>';
            $noti->persona = $ticket->titular;
        }else{
            $noti->usuario_id = $ticket->user_id;
            $noti->mensaje = 'El ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b> ha sido <b>cerrado</b>';
            $noti->persona = Auth::user()->name;
        }
        
        //almaceno notificación
        $noti->ticket_id = $ticket->id;
        $noti->save();

        return redirect()->action('ticketsController@list')->with('status','Ticket cerrado de manera satisfactoria');        
    }

    public function reapertura($id){
    
        $ticket = Tickets::find($id);
        $ticket->estado_id = 4;
        $ticket->save();

        $usuario = User::find(Auth::user()->id);

        //registro una respuesta avisando que el ticket ha sido cerrado y quien lo ha hecho        
        $respuesta = new TicketsRespuestas();
        $respuesta->ticket_id = $id;
        $respuesta->usuario_id = Auth::user()->id;
        $respuesta->respuesta = 'El ticket ha sido reabierto por el usuario '.$usuario->name.'.';
        $respuesta->save();

        //trabajo dinamica de notificacion respuesta.. debo validar quien contesta, si el usuario o el admin        
        $noti = new Notificaciones(); //creo el objeto de notificaciones

        //valido si el usuario titular del ticket es el que cierra, de no ser asi entonces se asume que es el admin
        if($ticket->user_id == Auth::user()->id ){
            $noti->usuario_id = $ticket->asignado;
            $noti->mensaje = 'El usuario <b>'.$ticket->usuarios->name.'</b> ha <b>reabierto</b> el ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b>';
            $noti->persona = $ticket->titular;
        }else{
            //valido si lo contesto un superadmin
            if(Auth::user()->rol == 2){

                //genero 2 notificaciones, pues al ser el superadmin, le notificará al usuario standar y al usaurio admin
                $noti2 = new Notificaciones();
                $noti2->usuario_id = $ticket->asignado;
                $noti2->mensaje = 'El ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b> ha sido <b>reabierto</b>';
                $noti2->persona = Auth::user()->name;
                $noti2->ticket_id = $ticket->id;
                $noti2->save();
                
                $noti->usuario_id = $ticket->user_id;
                $noti->mensaje = 'El ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b> ha sido <b>reabierto</b>';
                $noti->persona = Auth::user()->name;

            }else{
                $noti->usuario_id = $ticket->user_id;
                $noti->mensaje = 'El ticket <b>#'.$ticket->id.'</b> con asunto <b>'.$ticket->asunto.'</b> ha sido <b>reabierto</b>';
                $noti->persona = Auth::user()->name;
            }
        }
        
        //almaceno notificación
        $noti->ticket_id = $ticket->id;
        $noti->save();

        return redirect()->action('ticketsController@list')->with('status','Ticket reabierto de manera satisfactoria');
    }   

}
