@extends('dashboard')

@section('titulo','Mantenimientos')

@section('headers')
    <!-- Datatables -->
    <link href="{{ asset('gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">    
@endsection

@section('content')

    {{-- Bloque de mensajes --}}
    @if (session('status'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {!! session('status') !!}
      </div>
    @endif

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
              <h2>Mantenimientos <small>Listado Mantenimientos</small></h2><br><br>
              <a href="{{asset('/mantenimientos/nuevo_mantenimiento')}}" class="btn btn-primary btn-sm">Nuevo Mantenimiento</a>
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br/>
                {{-- Inicio Tabla --}}
                <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="14%">Cod</th>
                      <th width="14%">Tipo</th>
                      <th width="14%">Sticker equipo</th>
                      <th width="14%">Tipo equipo</th>
                      <th width="14%">Oficina</th>
                      <th width="14%">Fecha ingreso</th>
                      <th width="14%">Fecha programada</th>
                      <th width="14%">Fecha entrega</th>
                      <th width="14%">Estado</th>
                      <th width="14%"><center>Editar</center></th>
                      <th width="14%"><center>Ver</center></th>
                      {{-- <th width="3%"><center>Ver</center></th> --}}

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mantenimiento as $i => $item)
                      <tr>
                        <td><center>{{$item->id}}</center></td>
                        <td>
                          @if ($item->tipo == 1)
                              Preventivo
                          @else
                              Correctivo
                          @endif                          
                        </td>
                        <td>{{$item->sticker}}</td>
                        <td>{{$item->tipos->nombre}}</td>
                        <td>{{$item->oficinas->nombre}}</td>
                        <td>{{$item->fingreso}}</td>
                        <td>
                            @if ($item->fprogramada != null)
                              <center>{{$item->fprogramada}}</center>
                            @else
                            <center><a data-toggle="modal" data-target="#modal-update-{{$item->id}}" title="Ajustar fecha programada"><i class="fa fa-calendar btn btn-primary btn-xs "></i></a></center>
                            @endif  
                        </td>
                        <td>{{$item->fentrega}}</td>
                        {{-- and ($item->estado != null) and ($item->acciones != null) and ($item->conclusiones != null) and ($item->equipo_id != null) and ($item->fingreso != null) and ($item->fprogramada !=null) and ($item->fentrega != null) --}}
                        <td>
                            @if ( ($item->estado != null) and ($item->acciones != null) and ($item->conclusiones != null) and ($item->fentrega != null) )
                              Finalizado
                            @else
                              En proceso
                            @endif
                        </td>
                        
                        @if ( ($item->estado != null) and ($item->acciones != null) and ($item->conclusiones != null) and ($item->fentrega != null) )
                          <td><center><a href="{{ asset('/mantenimientos/editar/'.$item->id)}}" title="Mantenimiento finalizado, no se puede editar"><i class="fa fa-edit btn btn-default btn-xs" onclick="return false"></i></a></center></td>
                          <td><center><a target="_blank" href="{{ asset('/mantenimientos/hv/'.$item->id)}}" title="Ver mantenimiento"><i class="fa fa-file-pdf-o btn btn-primary btn-xs"></i></a></center></td>
                        @else
                          <td><center><a href="{{ asset('/mantenimientos/editar/'.$item->id)}}" title="Editar"><i class="fa fa-edit btn btn-primary btn-xs"></i></a></center></td>
                          <td><center><a target="_blank" href="{{ asset('/mantenimientos/hv/'.$item->id)}}" title="Mantenimiento NO finalizado"><i class="fa fa-file-pdf-o btn btn-default btn-xs" onclick="return false"></i></a></center></td>
                        @endif                       
                      </tr>
                      @include('mantenimientos/modal_programado')                      
                    @endforeach
                    
                  </tbody>  
                </table>
                {{-- Fin tabla --}}
            </div>
          </div>
        </div>
      </div>
    {{-- Final formulario --}}

@endsection

@section('imports')

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

    <script>      
        // Disable search and ordering by default
        $.extend( $.fn.dataTable.defaults, {
            //ordering:  false
            "order":[[0,"desc"]],
            language:{
              url: "{{ asset('gentelella/vendors/datatables.net/Spanish.json') }}" 
            }
        } );
    </script>

@endsection