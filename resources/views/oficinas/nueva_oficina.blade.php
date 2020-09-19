@extends('dashboard')

@section('titulo','Crear Antivirus')

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
        <h3>Gestión Oficinas</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Oficinas <small>Crear Oficina</small></h2><br><br>
            {{-- <a href="{{asset('/sistemas/nuevo_sistema')}}" class="btn btn-primary btn-sm">Nuevo Sistema</a> --}}
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            
            <form action="{{asset('/oficinas/guardar')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre Oficina <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">&nbsp; <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            Coordinación:
                            <input type="radio" class="flat" name="tipo" id="genderF" value="1" checked="" required />
                            Subdirección:
                            <input type="radio" class="flat" name="tipo" id="genderM" value="0" /> 
                          </p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">                        
                        <label for="" style="color:red"> * No agregar prefijos o sufijos de coordinación o subdirección, pues el sistema lo realiza automaticamente</label>
                    </div>
                </div> 
                
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{asset('/oficinas/ver_oficinas')}}" class="btn btn-danger">Regresar</a>                    
                    </div>
                </div>

                </form>
            
          </div>
        </div>
      </div>
    </div>
  {{-- Final formulario --}}
@endsection