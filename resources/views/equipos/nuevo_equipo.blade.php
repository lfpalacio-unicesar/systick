@extends('dashboard')

@section('titulo','Crear Equipo')

@section('headers')
    <link rel="stylesheet" href="{{asset('gentelella/vendors/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    
    {{-- Validaciones para los errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>    
                @endforeach
            </ul>
        </div>      
    @endif
    {{-- fin validaciones para los errores --}}


    {{-- Bloque de mensajes --}}
    @if (session('status'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! session('status') !!}
        </div>
    @endif
    {{-- fin bloque mensajes --}}
  
  {{-- Titulo de página  --}}
  <div class="page-title">
      <div class="title_left">
        <h3>Gestión Equipos</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Equipos <small>Crear Equipo</small></h2><br><br>
            {{-- <a href="{{asset('/sistemas/nuevo_sistema')}}" class="btn btn-primary btn-sm">Nuevo Sistema</a> --}}
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            
            <form action="{{asset('/equipos/guardar')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre Equipo
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre" name="nombre" class="form-control col-md-7 col-xs-12" value="{{old('nombre')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo Equipo <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="tipo_id" name="tipo_id">                          
                            @foreach ($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>                            
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">&nbsp; <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>¿Equipo critico?</b> &nbsp;&nbsp;&nbsp;
                            Si:
                            <input type="radio" class="flat" name="critico" value="1" checked="" required />
                            &nbsp;&nbsp;
                            No:
                            <input type="radio" class="flat" name="critico" value="0"/>                                
                            </p>
                    </div>
                </div> 

               

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Oficina <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="oficina_id" name="oficina_id">                          
                            @foreach ($oficinas as $oficina)
                                <option value="{{$oficina->id}}">{{$oficina->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marca <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="marca_id" name="marca_id">                          
                            @foreach ($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>                            
                            @endforeach                          
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modelo <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="modelo" name="modelo" required="required" class="form-control col-md-7 col-xs-12" value="{{old('modelo')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker Interno <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sticker" name="sticker" required="required" class="form-control col-md-7 col-xs-12" value="{{old('sticker')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker Monitor <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sticker_monitor" name="sticker_monitor" class="form-control col-md-7 col-xs-12" value="{{old('sticker_monitor')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker Teclado <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sticker_teclado" name="sticker_teclado" class="form-control col-md-7 col-xs-12" value="{{old('sticker_teclado')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker Mouse <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sticker_mouse" name="sticker_mouse" class="form-control col-md-7 col-xs-12" value="{{old('sticker_mouse')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Procesador
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="procesador" name="procesador" class="form-control col-md-7 col-xs-12" value="{{old('procesador')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Memoria RAM
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="ram" name="ram" class="form-control col-md-7 col-xs-12" value="{{old('ram')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Capacidad de almacenamiento
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="almacenamiento" name="almacenamiento" class="form-control col-md-7 col-xs-12" value="{{old('almacenamiento')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección IP
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="ip" name="ip" class="form-control col-md-7 col-xs-12" value="{{old('ip')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección física (MAC)
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="mac" name="mac" class="form-control col-md-7 col-xs-12" value="{{old('mac')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Software Instalado <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control multiples-softwares" id="softwares" name="softwares[]" multiple="multiple">                          
                            @foreach ($softwares as $software)
                                <option value="{{$software->id}}">{{$software->nombre}}</option>
                            @endforeach                 
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Version S.O <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="sistema_id" name="sistema_id">                          
                            @foreach ($sistemas as $sistema)
                                <option value="{{$sistema->id}}">{{$sistema->nombre}}</option>                            
                            @endforeach                          
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">&nbsp; <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Estado activación:</b> &nbsp;&nbsp;&nbsp;
                            Activo:
                            <input type="radio" class="flat" name="estadoSistema" value="1" />
                            &nbsp;&nbsp;
                            Inactivo:
                            <input type="radio" class="flat" name="estadoSistema" value="0"/>
                            &nbsp;&nbsp;
                            No requiere:
                            <input type="radio" class="flat" name="estadoSistema" value="2" checked="" required/>
                          </p>
                    </div>
                </div>                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Versión Suite Office <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="suite_id" name="suite_id">                          
                            @foreach ($suites as $suite)
                                <option value="{{$suite->id}}">{{$suite->nombre}}</option>                            
                            @endforeach                          
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">&nbsp; <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Estado activación:</b> &nbsp;&nbsp;&nbsp;
                            Activo:
                            <input type="radio" class="flat" name="estadoSuite" value="1" />
                            &nbsp;&nbsp;
                            Inactivo:
                            <input type="radio" class="flat" name="estadoSuite" value="0"/>
                            &nbsp;&nbsp;
                            No requiere:
                            <input type="radio" class="flat" name="estadoSuite" value="2" checked="" required/>
                          </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Antivirus <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="antivirus_id" name="antivirus_id">                          
                            @foreach ($antivirus as $anti)
                                <option value="{{$anti->id}}">{{$anti->nombre}}</option>                            
                            @endforeach                          
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">&nbsp; <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Estado activación:</b> &nbsp;&nbsp;&nbsp;
                            Activo:
                            <input type="radio" class="flat" name="estadoAntivirus" value="1" />
                            &nbsp;&nbsp;
                            Inactivo:
                            <input type="radio" class="flat" name="estadoAntivirus" value="0"/>
                            &nbsp;&nbsp;
                            No requiere:
                            <input type="radio" class="flat" name="estadoAntivirus" value="2" checked="" required/>
                          </p>
                    </div>
                </div>               

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Responsable <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="usuario_id" name="usuario_id">                          
                            @foreach ($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>                            
                            @endforeach                          
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Asignado a
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="asignado" name="asignado" class="form-control col-md-7 col-xs-12" value="{{old('asignado')}}" placeholder="Nombre persona que tiene el equipo asignado">
                    </div>
                </div>
                
                <div class="form-group">                            
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha compra <span class="required">*</span>
                    </label>    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="date" class="form-control has-feedback-left" id="single_cal2_" name="fcompra" required="required" aria-describedby="inputSuccess2Status2" value="{{old('fcompra')}}">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                    </div>                 
                </div>      
                
                <div class="form-group">                            
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha instalación <span class="required"></span>
                    </label>    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="date" class="form-control has-feedback-left" id="single_cal3_" name="finstalacion" value="{{old('finstalacion')}}">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                    </div>                 
                </div>                
                                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{asset('/equipos/ver_equipos')}}" class="btn btn-danger">Regresar</a>                    
                    </div>
                </div>
            </form>            
          </div>
        </div>
      </div>
    </div>
  {{-- Final formulario --}}
@endsection

@section('imports')
    <script src="{{ asset('gentelella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.multiples-softwares').select2();
        });
    </script>
@endsection