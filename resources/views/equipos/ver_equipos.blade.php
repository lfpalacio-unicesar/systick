@extends('dashboard')

@section('titulo','Equipos')

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
        {{ session('status') }}
    </div>
  @endif

  @if (session('status2'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! session('status2') !!}
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
            <h2>Equipos <small>Listado Equipos</small></h2><br><br>
            <a href="{{asset('/equipos/nuevo_equipo')}}" class="btn btn-primary btn-sm">Nuevo Equipo</a>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
              {{-- Inicio Tabla --}}
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="2%">#</th>
                    <th width="10%">Tipo Equipo</th>
                    <th width="5%">¿Critico?</th>
                    <th width="25%">Oficina</th>
                    <th width="15%">Fabricante</th>
                    <th width="13%">Modelo</th>
                    <th width="7%">Sticker</th>
                    <th width="7%">Ver</th>
                    <th width="7%">Editar</th>
                    <th width="9%">Pdf</th>                    
                    {{-- <th width="5%" colspan="3"><center>Acciones</center></th>                     --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($equipos as $i => $equipo)
                    <tr>
                        <td><center>{{$i+1}}</center></td>
                        <td>{{$equipo->tipos->nombre}}</td>
                        <td> @if ($equipo->critico==0) No @else Si @endif </td>
                        <td>{{$equipo->oficinas->nombre}}</td>
                        <td>{{$equipo->marcas->nombre}}</td>
                        <td>{{$equipo->modelo}}</td>
                        <td>{{$equipo->sticker}}</td>
                        
                      <td><center><a data-toggle="modal" data-target="#modal-detail-{{$equipo->id}}" title="ver"><i class="fa fa-eye btn btn-primary btn-xs "></i></a></center></td>
                      @if ($equipo->estado == 1)
                        <td><center><a href="{{ asset('/equipos/editar/'.$equipo->id)}}" title="editar"><i class="fa fa-edit btn btn-primary btn-xs"></i></a></center></td>    
                      @else
                        <td><center><a href="{{ asset('/equipos/editar/'.$equipo->id)}}"><i class="fa fa-edit btn btn-default btn-xs" onclick="return false"></i></a></center></td>  
                      @endif
                      
                      {{-- {{dd($equipo->mantenimientos($equipo->id))}} --}}
                      @if ($equipo->mantenimientos($equipo->id) != 0)
                        <td><center><a href="{{ asset('/equipos/hojaVida/'.$equipo->id)}}" title="Hoja de vida"><i class="fa fa-file-pdf-o btn btn-primary btn-xs"></i></a></center></td>    
                      @else
                        <td><center><a href="{{ asset('/equipos/hojaVida/'.$equipo->id)}}" title="NO tiene mantenimientos asociados"><i class="fa fa-file-pdf-o btn btn-default btn-xs" onclick="return false"></i></a></center></td>  
                      @endif
                      
                      
                    </tr>    
                    @include('equipos/modal_detalles_equipo')
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
          language:{
          url: "{{ asset('gentelella/vendors/datatables.net/Spanish.json') }}" 
          }
      } );
  </script>

@endsection
