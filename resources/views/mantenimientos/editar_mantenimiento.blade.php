@extends('dashboard')

@section('titulo','Editar mantenimiento')

@section('headers')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

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
                <h2>Mantenimientos <small>Editar Mantenimiento</small></h2><br><br>
              {{-- <a href="{{asset('/mantenimientos/nuevo_mantenimiento')}}" class="btn btn-primary btn-sm">Nuevo Mantenimiento</a> --}}
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br/>

              <form action="{{ asset('/mantenimientos/actualizar') }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                  {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo Mantenimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="tipo" id="tipo" class="form-control" disabled>
                                @if ($mante->tipo == 1)
                                    <option selected value="1">Preventivo</option>    
                                @else
                                    <option selected value="2">Correctivo</option>    
                                @endif                              
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sticker Equipo <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="equipo_id" id="equipo_id" class="form-control" disabled required>
                              {{-- <option selected disabled value="">Seleccione equipo</option> --}}
                              @foreach ($equipo as $item)
                                @if ($item->id == $mante->equipo_id)
                                    <option selected value="{{$item->id}}">{{$item->sticker .' - '.$item->tipos->nombre.' - '.$item->oficinas->nombre}}</option>                                    
                                @endif
                              @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha ingreso <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" name="fingreso" id="fingreso" class="form-control" style="width:170px" value="{{$mante->fingreso}}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha programada
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if ($mante->fprogramada != null)
                                <input type="date" name="fprogramada" id="fprogramada" class="form-control" style="width:170px" value="{{$mante->fprogramada}}" disabled>
                            @else
                                <input type="date" name="fprogramada" id="fprogramada" class="form-control" style="width:170px" value="{{ old('fprogramada') }}">    
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha entrega
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if ($mante->fentrega != null)
                                <input type="date" name="fentrega" id="fentrega" class="form-control" style="width:170px" value="{{$mante->fentrega}}" disabled>
                            @else
                                <input type="date" name="fentrega" id="fentrega" class="form-control" style="width:170px" value="{{ old('fentrega') }}">                                
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado recibido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if ($mante->estado != null)
                                <textarea id="estado" name="estado" rows="5" class="form-control col-md-7 col-xs-12" disabled>{!!$mante->estado!!}</textarea>
                            @else
                                <textarea id="estado" name="estado" rows="5" class="form-control col-md-7 col-xs-12"></textarea>    
                            @endif
                                                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Acciones realizadas <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if ($mante->acciones != null)
                                <textarea id="acciones" name="acciones" rows="5" class="form-control col-md-7 col-xs-12" disabled>{!!$mante->acciones!!}</textarea>
                            @else
                                <textarea id="acciones" name="acciones" rows="5" class="form-control col-md-7 col-xs-12">{{ old('acciones') }}</textarea>    
                            @endif
                                                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Conclusiones o recomendaciones<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if ($mante->conclusiones != null)
                                <textarea id="conclusiones" name="conclusiones" rows="5" class="form-control col-md-7 col-xs-12" disabled>{!!$mante->conclusiones!!}</textarea>
                            @else
                                <textarea id="conclusiones" name="conclusiones" rows="5" class="form-control col-md-7 col-xs-12">{{ old('conclusiones') }}</textarea>                                
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="id" value="{{$mante->id}}">

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
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

  // $(document).ready(function() {
  //     $('.js-example-basic-single').select2();
  // });

  $(function () {    
    $('#equipo_id').select2()      
  })
</script>

    
@endsection