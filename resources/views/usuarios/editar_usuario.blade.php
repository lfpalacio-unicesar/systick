@extends('dashboard')

@section('titulo','Editar Usuario')

@section('content')

    {{-- Bloque de mensajes --}}
    @if (session('status'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! session('status') !!}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{-- {{ session('status') }} --}}
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif 
  
  {{-- Titulo de página  --}}
  <div class="page-title">
      <div class="title_left">
        <h3>Gestión Usuarios</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Usuarios <small>Editar Usuario</small></h2><br><br>
            {{-- <a href="{{asset('/sistemas/nuevo_sistema')}}" class="btn btn-primary btn-sm">Nuevo Sistema</a> --}}
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            
            <form action="{{asset('/usuarios/actualizar')}}" method="POST" files="true" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}                

                <input type="hidden" name="id" id="id" value="{{$usuario->id}}">
                <div class="clearfix"></div>

                <img src="{{ asset('images/profiles/'.$usuario->imagen)}}" alt="..."  width="100" height="100" class="img-circle">
                               
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre personal <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="{{$usuario->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cedula <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="username" name="username" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required="required" class="form-control col-md-7 col-xs-12" value="{{$usuario->username}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{$usuario->email}}">
                    </div>
                </div>

                {{-- valido la edicion del estado del usuario en base al rol --}}
                @if (Auth::user()->rol < 2)
                     <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado usuario <span class="required">*</span>
                    </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="estado" name="estado" disabled>  
                                @if ($usuario->estado == 0)
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>    
                                @else
                                    <option value="1">Activo</option>    
                                    <option value="0">Inactivo</option>
                                @endif                                                     
                            </select>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado usuario <span class="required">*</span>
                    </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="estado" name="estado">  
                                @if ($usuario->estado == 0)
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>    
                                @else
                                    <option value="1">Activo</option>    
                                    <option value="0">Inactivo</option>
                                @endif                                                     
                            </select>
                        </div>
                    </div>                    
                @endif
               
                {{-- valido la edicion del rol del usuario en base al rol --}}
                @if (Auth::user()->rol < 2)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rol usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="rol" name="rol" disabled>                          
                                @if ($usuario->rol ==0)
                                    <option value="0">Usuario</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Super Administrador</option>    
                                @elseif($usuario->rol == 1)
                                    <option value="1">Administrador</option>
                                    <option value="2">Super Administrador</option>
                                    <option value="0">Usuario</option>
                                @else
                                    <option value="2">Super Administrador</option>
                                    <option value="1">Administrador</option>
                                    <option value="0">Usuario</option>
                                @endif
                                                        
                            </select>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rol usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="rol" name="rol">                          
                                @if ($usuario->rol ==0)
                                    <option value="0">Usuario</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Super Administrador</option>    
                                @elseif($usuario->rol == 1)
                                    <option value="1">Administrador</option>
                                    <option value="2">Super Administrador</option>
                                    <option value="0">Usuario</option>
                                @else
                                    <option value="2">Super Administrador</option>
                                    <option value="1">Administrador</option>
                                    <option value="0">Usuario</option>
                                @endif
                                                        
                            </select>
                        </div>
                    </div>                    
                @endif

                @if (Auth::user()->rol < 2)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Oficina <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="oficina_id" name="oficina_id" disabled>                          
                                @foreach ($oficinas as $oficina)
                                    @if ($oficina->id == $usuario->oficina_id)
                                        <option selected="selected" value="{{$oficina->id}}">{{$oficina->nombre}}</option>
                                    @else
                                        <option value="{{$oficina->id}}">{{$oficina->nombre}}</option>                                    
                                    @endif
                                @endforeach                                                      
                            </select>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Oficina <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="oficina_id" name="oficina_id">                          
                                @foreach ($oficinas as $oficina)
                                    @if ($oficina->id == $usuario->oficina_id)
                                        <option selected="selected" value="{{$oficina->id}}">{{$oficina->nombre}}</option>
                                    @else
                                        <option value="{{$oficina->id}}">{{$oficina->nombre}}</option>                                    
                                    @endif
                                @endforeach                                                      
                            </select>
                        </div>
                    </div>
                @endif                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                        <input type="password" class="form-control" name="password" id="password" onpaste="return false">
                        <span class="input-group-btn">                            
                            <button id="show_password" type="button" class="btn btn-primary" onclick="mostrarPassword()"><i class="fa fa-eye-slash icon"></i></button>                            
                        </span>
                    </div>                                            
                </div> 
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirmar Contraseña <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                        <input type="password" class="form-control" name="password_confirm" id="password-confirm" onpaste="return false">
                        <span class="input-group-btn">                            
                            <button id="show_password" type="button" class="btn btn-primary" onclick="mostrarPassword2()"><i class="fa fa-eye-slash iconn"></i></button>                            
                        </span>
                    </div>                                            
                </div>
                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imagen
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="imagen" name="imagen" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>               
                
                <div class="ln_solid"></div>
                
                <div class="form-group has-feedback form-group has-feedback">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        @if (Auth::user()->rol != 0)                            
                            <a href="{{asset('/usuarios/ver_usuarios')}}" class="btn btn-danger">Regresar</a>                        
                        @endif                                            
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
    
    <script type="text/javascript">
        function mostrarPassword(){
            var cambio = document.getElementById("password");
            if(cambio.type == "password"){
                cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
         }        
    </script>

    <script type="text/javascript">
        function mostrarPassword2(){
            var cambio = document.getElementById("password-confirm");
            if(cambio.type == "password"){
                cambio.type = "text";
            $('.iconn').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.iconn').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }        
    </script>
@endsection