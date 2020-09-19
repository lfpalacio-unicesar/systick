@extends('dashboard')

@section('titulo','Editar Sistemas')

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
        <h3>Gestión Sistemas Operativos</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sistemas <small>Editar Sistema Operativo</small></h2><br><br>
            {{-- <a href="{{asset('/sistemas/nuevo_sistema')}}" class="btn btn-primary btn-sm">Nuevo Sistema</a> --}}
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            
            <form action="{{asset('/sistemas/actualizar')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre Sistema Operativo <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="id" value="{{$sistema->id}}">   
                    <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="{{$sistema->nombre}}">
                    </div>
                </div>               
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{asset('/sistemas/ver_sistemas')}}" class="btn btn-danger">Regresar</a>                    
                    </div>
                </div>

                </form>
            
          </div>
        </div>
      </div>
    </div>
  {{-- Final formulario --}}
@endsection