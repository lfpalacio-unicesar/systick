@extends('dashboard')

@section('titulo','Nuevo mantenimiento')

@section('headers')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
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
    @if (session('status2'))
        <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! session('status2') !!}
        </div>
    @endif

    {{-- titulo de la página --}}
    <div class="page-title">
        <div class="title_left">
        <h3>Gestión Mantenimientos</h3>
        </div>    
    </div>
    
    {{-- fin titulo de la página --}}
    <div class="clearfix"></div>

    {{-- Inicio formulario --}}
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Mantenimientos <small>Crear Mantenimiento</small></h2><br><br>
              {{-- <a href="{{asset('/mantenimientos/nuevo_mantenimiento')}}" class="btn btn-primary btn-sm">Nuevo Mantenimiento</a> --}}
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br/>

              <form action="{{ asset('/mantenimientos/guardar') }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                  {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo Mantenimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="tipo" id="tipo" class="form-control">
                                {{--valido si el old de tipo viene vacio para establecer el orden de los select por defecto  --}}
                                @if (null !== (old('tipo')))
                                    
                                    {{-- valido el old de tipo para recuperar el tipo de mantenimiento --}}
                                    @if ( old('tipo') == 1)
                                        <option value="1" selected>Preventivo</option>    
                                        <option value="2">Correctivo</option>
                                    @else
                                        <option value="1">Preventivo</option>    
                                        <option value="2" selected>Correctivo</option>
                                    @endif
                                @else
                                    <option value="1" selected>Preventivo</option>    
                                    <option value="2">Correctivo</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker Equipo <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="equipo_id" id="equipo_id" class="form-control" required>
                              <option selected disabled value="">Seleccione equipo</option>
                              @foreach ($equipo as $item)
                                    @if ( old('equipo_id') == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->sticker .' - '.$item->tipos->nombre.' - '.$item->oficinas->nombre}}</option>        
                                    @else
                                        <option value="{{$item->id}}">{{$item->sticker .' - '.$item->tipos->nombre.' - '.$item->oficinas->nombre}}</option>
                                    @endif
                                
                              @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha ingreso <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" name="fingreso" id="fingreso" class="form-control" style="width:170px" required value="{{ old('fingreso') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha programada
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" name="fprogramada" id="fprogramada" class="form-control" style="width:170px" value="{{ old('fprogramada') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha entrega
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" name="fentrega" id="fentrega" class="form-control" style="width:170px" value="{{ old('fentrega') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado recibido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="estado" required="required" name="estado" rows="5" class="form-control col-md-7 col-xs-12">{{ old('estado') }}</textarea>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Acciones realizadas
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="acciones" name="acciones" rows="5" class="form-control col-md-7 col-xs-12">{{ old('acciones') }}</textarea>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Conclusiones o recomendaciones
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="conclusiones" name="conclusiones" rows="5" class="form-control col-md-7 col-xs-12">{{ old('conclusiones') }}</textarea>                            
                        </div>
                    </div>

                    {{-- <input type="hidden" name="responsable" value="{{Auth::user()->id}}"> - lo hago desde el controlador --}}

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{asset('/mantenimientos/ver_mantenimientos')}}" class="btn btn-danger">Regresar</a>                    
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      
{{-- Select 2 --}}
<script>
  $(function () {    
    $('#equipo_id').select2()      
  })
</script>
    
@endsection