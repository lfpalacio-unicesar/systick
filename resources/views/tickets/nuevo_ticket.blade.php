@extends('dashboard')

@section('titulo','Crear Ticket')

@section('headers')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{-- {{ session('status') }} --}}
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif 

@if (session('status2'))
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! session('status2') !!}
    </div>
@endif
  
  {{-- Titulo de página  --}}
  <div class="page-title">
      <div class="title_left">
        <h3>Gestión Tickets</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tickets <small>Crear Tickets</small></h2><br><br>
            {{-- <a href="{{asset('/sistemas/nuevo_sistema')}}" class="btn btn-primary btn-sm">Nuevo Sistema</a> --}}
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            
            <form action="{{asset('/tickets/guardar')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left" role="form" files="true" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de servicio <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="servicio_id" name="servicio_id" onchange="if(this.value == 1){document.getElementById('equipo_id').disabled=false}else{document.getElementById('equipo_id').disabled=true}">                          
                            @foreach ($servicios as $servicio)
                                @if ( old('servicio_id') == $servicio->id)
                                    <option value="{{$servicio->id}}" selected>{{$servicio->nombre}}</option>
                                @else                                    
                                    <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>                            
                                @endif
                            @endforeach                          
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker equipo <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{-- valido si el old de servicios no esta vacio --}}
                        @if (null !== (old('servicio_id')))
                            {{-- valido si el old de servicios es diferente de 1, de serlo, me inhabilita el select de equipos --}}
                            @if (old('servicio_id') != 1)
                                <select name="equipo_id" id="equipo_id" class="form-control" disabled>
                                    @foreach ($equipos as $equipo)
                                    <option value="{{$equipo->id}}">{{$equipo->sticker .' - '.$equipo->tipos->nombre.' - '.$equipo->oficinas->nombre}}</option>                                
                                    @endforeach
                                </select>
                            @else   
                                {{-- se encontró que el old de servicios tiene valor uno y se habilita el select de equipos --}}
                                <select name="equipo_id" id="equipo_id" class="form-control">
                                    @foreach ($equipos as $equipo)

                                        {{-- valido si el old de equipo es igual al equipo_id para poder recuperar la seleccion que se habia hecho antes --}}
                                        @if ( old('equipo_id') == $equipo->id)
                                            <option value="{{$equipo->id}}" selected>{{$equipo->sticker .' - '.$equipo->tipos->nombre.' - '.$equipo->oficinas->nombre}}</option>        
                                        @else
                                            <option value="{{$equipo->id}}">{{$equipo->sticker .' - '.$equipo->tipos->nombre.' - '.$equipo->oficinas->nombre}}</option>
                                        @endif                                   
                                    
                                    @endforeach
                                </select>
                            @endif
                        @else   
                                {{-- carga el select de equipos --}}
                            <select name="equipo_id" id="equipo_id" class="form-control">
                                @foreach ($equipos as $equipo)
                                <option value="{{$equipo->id}}">{{$equipo->sticker .' - '.$equipo->tipos->nombre.' - '.$equipo->oficinas->nombre}}</option>                                
                                @endforeach
                            </select>
                        @endif                       
                        
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titular solicitud <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="titular" name="titular" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre persona que solicita el ticket" maxlength="30" value="{{ old('titular') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Asunto <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="asunto" name="asunto" required="required" class="form-control col-md-7 col-xs-12" placeholder="Asunto o título ticket" value="{{ old('asunto') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Descripción ticket <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="descripcion" required="required" name="descripcion" class="form-control col-md-7 col-xs-12" rows="7">{{ old('descripcion') }}</textarea>                        
                    </div>
                </div>

                <input type="hidden" name="estado_id" value="1">
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Archivos <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
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
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{asset('/tickets/ver_tickets')}}" class="btn btn-danger">Regresar</a>                    
                    </div>
                </div>

                </form>
            
          </div>
        </div>
      </div>
    </div>
  {{-- Final formulario --}}


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
@endsection

@section('imports')

    {{-- Select 2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>      
    <script>
        $(function () {    
            $('#equipo_id').select2()      
        })
    </script>
    
@endsection

