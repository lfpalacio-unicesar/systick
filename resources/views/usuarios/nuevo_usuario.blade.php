@extends('dashboard')

@section('titulo','Crear Usuario')

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
            <h2>Usuarios <small>Crear Usuario</small></h2><br><br>
            {{-- <a href="{{asset('/sistemas/nuevo_sistema')}}" class="btn btn-primary btn-sm">Nuevo Sistema</a> --}}
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            
            <form action="{{asset('/usuarios/guardar')}}" method="POST" files="true" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre personal <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="{{old('name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cedula <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="username" name="username" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  onpaste="return false" required="required" class="form-control col-md-7 col-xs-12" value="{{old('username')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{old('email')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado usuario <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="estado" name="estado">                          
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>                          
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rol usuario <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="rol" name="rol">                          
                            <option value="0">Usuario</option>
                            <option value="1">Administrador</option>
                            <option value="2">Super Administrador</option>                          
                        </select>
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
                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" onpaste="return false">
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
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{asset('/usuarios/ver_usuarios')}}" class="btn btn-danger">Regresar</a>                    
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

    {{-- <script type="text/javascript">
        function validar_num(evento){
            evento.value = evento.value.replace(/[^0-9]/g,"");
        }
    </script> --}}
    
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