@extends('dashboard')

@section('titulo','Ver ticket')

@section('headers')    
    {{-- librerias de linea de tiempo --}}
    <link rel="stylesheet" href="{{ asset('gentelella/timeline2/css/timelinestyle.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
    
    {{-- libreria PNotify --}}
    {{-- <link rel="stylesheet" href="{{ asset('gentelella/vendors/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" href="{{ asset('gentelella/vendors/pnotify/dist/pnotify.buttons.css')}}">
    <link rel="stylesheet" href="{{ asset('gentelella/vendors/pnotify/dist/pnotify.nonblock.css')}}"> --}}

    {{-- clase que redondea la imagen de usuario --}}
    <style>
      .imgRedonda{         
          border-radius:150px;
      } 
    </style>
    
    {{-- librerias select2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />    
    
@endsection

@section('content')



  {{-- Bloque de mensajes --}}
  @if (session('status'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! session('status') !!}
    </div>
  @endif 
  
  @if (session('status3'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! session('status3') !!}
    </div>
  @endif 

  @if (session('status2'))

    <button class="btn btn-default source" onload="new PNotify({
        title: 'Regular Success',
        text: 'That thing that you were trying to do worked!',
        type: 'success',
        styling: 'bootstrap3'
        });">Success</button>
    {{-- PNotify.success({
        text: "I'm a success message."
    }); --}}
  @endif
  {{-- fin bloque mensajes --}}
  
  {{-- Titulo de página  --}}
  <div class="page-title">
      <div class="title_left">
        <h3>Ver Ticket</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio paneles superiores --}}
  <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Resumen ticket # {{$ticket->id}}</h2><br>           
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            
            {{-- resumen del ticket --}}
            <h5><b>Tipo servicio: &nbsp;&nbsp;</b> <i>{{$ticket->servicios->nombre}}</i></h5>
            @if ($ticket->equipo_id != null)
                <h5><b>Sticker equipo:&nbsp;</b> <i>{{$ticket->equipos->sticker}}</i></h5>            
            @endif
            
            <h5><b>Titular ticket:&nbsp;&nbsp;&nbsp;&nbsp;</b> <i>{{$ticket->titular}}</i></h5>
            <h5><b>Asunto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <i>{{$ticket->asunto}}</i></h5>
            <h5><b>Estado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <i>{{$ticket->estados->nombre}}</i></h5>
            <h5><b>Asignado a:</b>
              @if ($ticket->asignado == null)
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i><b style="color:red">Sin asignar</b></i>
              @else
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>{{$ticket->asignado2->name}}</i>
              @endif
            </h5>
            @if (($rol == 2 and $ticket->estado_id == 5) or ($rol != 2))
                <hr>
                <a href="{{asset('/tickets/ver_tickets')}}" class="btn btn-danger btn-sm">Regresar</a>    
            @endif 
                          
          </div>
        </div>
      </div>

      {{-- panel izquierdo --}}
      {{-- valido el rol del usuario --}}
      @if ($rol == 2 and $ticket->estado_id != 5)
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Asignación ticket</h2><br>           
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br/>
              {{-- resumen del ticket --}}
              <form action="{{ asset('/tickets/asignar') }}" method="POST">
                  {{ csrf_field() }}
                  <select name="asignado" id="asignado" class="form-control">
                      @foreach ($usuarios as $user)
                        {{-- excluyo el usuario actual, para no reasignar el ticket al mismo usuario --}}
                        @if ($ticket->asignado != $user->id)                            
                          <option value="{{$user->id}}">{{$user->name}}</option>                      
                        @endif
                      @endforeach
                  </select>

                  <input type="hidden" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Asignar</button>
                        <a href="{{asset('/tickets/ver_tickets')}}" class="btn btn-danger">Regresar</a>                    
                    </div>
                </div>
                  
              </form> 
                
            </div>
          </div>
        </div>
      @endif      
        
    </div>  
  {{-- Final paneles superiores --}}


  {{-- inicio panel de mensajes --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                <h2>Historial Ticket </h2><br><br>               
                <div class="clearfix"></div>
              </div>

              <div class="x_content">                                  
                <section id="timeline-wrapper">
                  <div class="container-fluid">
                      <div class="row">                
                          <div class="timeline-top">
                              <div class="top-year"><!--<h4>Caso <h5>4600000</h5></h4>-->Inicio</span></div>        
                          </div>
                          <div class="timeline-block">
                              <div class="timeline-events">             
          
                                  <div class="event l-event col-md-6 col-sm-6 col-xs-8 "> <!--Evento izquierda-->
                                      <span class="thumb fa fa-circle-o-notch"></span>
                                      <div class="event-body">
                                          <div class="person-image pull-left"><img src="{{asset('images/profiles/'.$ticket->usuarios->imagen)}}" class="imgRedonda" alt="person"/></div>
                                          <div class="event-content">
                                              <h5 class="text-primary text-left">{{$ticket->usuarios->name}} </h5>
                                              <span class="text-muted text-left" style="display:block; margin: 0"><small>{{date_format($ticket->created_at,'Y-m-d  //  H:i:s')}}</small></span>                                    
                                              <blockquote class="text-muted text-left"><h5>{!!$ticket->descripcion!!}</h5>
                                                  <!--<cite class="text-muted text-right text-bold"><b><h5>Luis Felipe Palacio Salamanca</h5></b></cite>-->
                                                  {{-- aqui se cargan los archivos adjuntos con el ticket --}}
                                                  @if ($archivos != null)                                                      
                                                      @foreach ($archivos as $archivo)
                                                          <a target="_blank" href="{{asset('files/tickets/'.$archivo->ruta)}}"><h5 class="text-primary">{{$archivo->nombre}}</h5></a>
                                                      @endforeach    
                                                  @endif
                                                  
                                              </blockquote>                                
                                          </div>
                                      </div> <!-- end of event body -->
                                      <div class="clearfix"></div>
                                  </div><!-- end of left event -->
                                  
                                  {{-- foraeach para mostrar las respuestas --}}
                                  @foreach ($respuestas as $respuesta)
                                  
                                    <div class="row"></div>
                                    {{-- validar el id del usuario del ticket con el id del usuario de la respuesta --}}
                                    @if ($respuesta->usuarios->id == $ticket->usuarios->id)
                                        <div class="event l-event col-md-6 col-sm-6 col-xs-8 "> <!--Evento izquierda-->
                                    @else
                                        <div class="event r-event col-md-6 col-sm-6 col-xs-8 "> <!--Evento derecha-->    
                                    @endif                                    
                                        <span class="thumb fa fa-circle-o-notch"></span>
                                        <div class=" event-body">
                                            <div class="person-image pull-left"><img src="{{asset('images/profiles/'.$respuesta->usuarios->imagen)}}" class="imgRedonda" alt="person"/></div>
                                            <div class="event-content">
                                                <h5 class="text-primary text-left">{{$respuesta->usuarios->name}} </h5>
                                                <span class="text-muted text-left" style="display:block; margin: 0"><small>{{ date_format($respuesta->created_at,'Y-m-d  //  H:i:s')}}</small></span>                                    
                                                <blockquote class="text-muted text-left"><h5>{!!$respuesta->respuesta!!}</h5>
                                                    <!--<cite class="text-muted text-right text-bold">- Alex Martin</cite>-->
                                                    @if ($archivos_respuestas != null)
                                                        @foreach ($archivos_respuestas as $file)
                                                            @if ($file->respuesta_id == $respuesta->id)
                                                            <a target="_blank" href="{{asset('files/respuestas/'.$file->ruta)}}"><h5 class="text-primary">{{$file->nombre}}</h5></a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </blockquote>                                                                            
                                            </div>
                                        </div> <!--end of event body-->
                                        <div class="clearfix"></div>
                                    </div><!-- end of right event <-->

                                  @endforeach                                                                                                    
                              </div><!-- end of timeline events -->
                              <div class="clearfix"></div>
                          </div><!-- end of timeline-block-->
          
                      </div><!--close row-->
                      <br>{{--espacio para que el final de historial no quede pegado al pie de la pagina--}}
                  </div><!--close container-fluid-->
              </section>
              </div>{{--cierra x_content--}}            
          </div> {{--cierra x_panel--}}        
      </div> {{--cierra col--}} 
  </div>{{--cierra row--}}
  {{-- final panel de mensajes --}}

  {{-- inicio fila de mensaje --}}
  @if ( $ticket->estado_id == 2 or $ticket->estado_id == 3 or $ticket->estado_id == 4 or ($ticket->estado_id == 1 and $ticket->user_id == Auth::user()->id)  )      
  
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                <h2>Respuesta ticket </h2><br><br>               
                <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form action="{{ asset('/tickets/respuestas') }}" method="POST" data-parsley-validate class="form-horizontal form-label-left" role="form" files="true" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <textarea id="editor1" name="respuesta" rows="10" cols="80">  {{old('respuesta')}}                                                 
                        </textarea>
                        
                        {{-- archivos --}}
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Archivos
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                {{-- <input type="file" name="files" id="files"> --}}
                                <dl>
                                    <dd>
                                        <!-- Esta div contendrá todos los campos file que creemos -->
                                        <div id="adjuntos">
                                            <!-- Hay que prestar atención a esto, el nombre de este campo debe siempre terminar en []
                                            como un vector, y ademas debe coincidir con el nombre que se da a los campos nuevos 
                                            en el script -->
                                            <input type="file" name="archivos[]" /><br />
                                        </div>
                                    </dd>
                                    <dt><a onClick="addCampo()" style="cursor:pointer;color:#006699;">Subir otro archivo</a></dt>
                                </dl>
                            </div>
                        </div>
                        {{-- campos ocultos --}}
                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                        <input type="hidden" name="usuario_id" value="{{Auth::user()->id}}">

                        {{-- final archivos --}}
                        <div class="row"></div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{asset('/tickets/ver_tickets')}}" class="btn btn-danger">Regresar</a>                    
                            </div>
                        </div>
                        {{-- <br><br><br> --}}
                    </form>
                </div>

            </div> {{--cierre x_pane--}}
        </div> {{--cierre col mensaje--}}    
    </div> {{--cierre row mensaje--}}

  {{--final fila de mensaje --}} 
  @endif

  
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <br><br>        
      </div>
  </div>


@endsection

@section('imports')

<script>
    var numero = 0; //Esta es una variable de control para mantener nombres
                //diferentes de cada campo creado dinamicamente.
    evento = function (evt) { //esta funcion nos devuelve el tipo de evento disparado
        return (!evt) ? event : evt;
    }

    //Aqui se hace lamagia... jejeje, esta funcion crea dinamicamente los nuevos campos file
    addCampo = function () { 
    //Creamos un nuevo div para que contenga el nuevo campo
        nDiv = document.createElement('div');
    //con esto se establece la clase de la div
        nDiv.className = 'archivo';
    //este es el id de la div, aqui la utilidad de la variable numero
    //nos permite darle un id unico
        nDiv.id = 'file' + (++numero);
    //creamos el input para el formulario:
        nCampo = document.createElement('input');
    //le damos un nombre, es importante que lo nombren como vector, pues todos los campos
    //compartiran el nombre en un arreglo, asi es mas facil procesar posteriormente con php
        nCampo.name = 'archivos[]';
    //Establecemos el tipo de campo
        nCampo.type = 'file';
    //Ahora creamos un link para poder eliminar un campo que ya no deseemos
        a = document.createElement('a');
    //El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
        a.name = nDiv.id;
    //Este link no debe ir a ningun lado
        a.href = 'javascript:';
    //Establecemos que dispare esta funcion en click
        a.onclick = elimCamp;
    //Con esto ponemos el texto del link
        a.innerHTML = 'Eliminar';
    //Bien es el momento de integrar lo que hemos creado al documento,
    //primero usamos la función appendChild para adicionar el campo file nuevo
        nDiv.appendChild(nCampo);
    //Adicionamos el Link
        nDiv.appendChild(a);
    //Ahora si recuerdan, en el html hay una div cuyo id es 'adjuntos', bien
    //con esta función obtenemos una referencia a ella para usar de nuevo appendChild
    //y adicionar la div que hemos creado, la cual contiene el campo file con su link de eliminación:
        container = document.getElementById('adjuntos');
        container.appendChild(nDiv);
    }
    //con esta función eliminamos el campo cuyo link de eliminación sea presionado
    elimCamp = function (evt){
        evt = evento(evt);
        nCampo = rObj(evt);
        div = document.getElementById(nCampo.name);
        div.parentNode.removeChild(div);
    }
    //con esta función recuperamos una instancia del objeto que disparo el evento
    rObj = function (evt) { 
        return evt.srcElement ?  evt.srcElement : evt.target;
    }
    
    function cerrar() {
        ventana=window.self; 
        ventana.opener=window.self; 
        ventana.close();
    }		
</script>

    <!-- Datatables -->
    <script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    
    {{-- librerias Pnotify --}}
    {{-- <script src="{{ asset('gentelella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script> --}}

    {{-- Librerias linea de tiempo --}}
    <script src="{{asset('gentelella/timeline2/js/timelinejs.js')}}"></script>
    <script src="{{asset('gentelella/timeline2/js/TweenMax.min.js')}}"></script>
    
    {{-- Select 2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>      
    <script>
        $(function () {    
            $('#asignado').select2()      
        })
    </script>

    <!--importa CK Editor-->
    <script src="{{ asset('gentelella/vendors/ckeditor/ckeditor.js') }}"></script>
    
    <!--Script que asocia el ckeditor.js con el textarea-->
    <script>
        $(function () {            
            CKEDITOR.replace('editor1')            
        })
    </script>

@endsection