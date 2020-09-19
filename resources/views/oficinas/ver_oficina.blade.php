@extends('dashboard')

@section('titulo','Oficinas')

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
  {{-- mensaje de error eliminacion de registro --}}
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
            <h2>Oficinas <small>Listado Oficinas</small></h2><br><br>
            <a href="{{asset('/oficinas/nueva_oficina')}}" class="btn btn-primary btn-sm">Nueva Oficina</a>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
              {{-- Inicio Tabla --}}
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="3%">#</th>
                    <th width="87%">Oficina</th>
                    <th width="5%"><center>Editar</center></th>
                    <th width="5%"><center>Eliminar</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($oficinas as $i => $oficina)
                    <tr>
                      <td><center>{{$i+1}}</center></td>
                      <td>{{$oficina->nombre}}</td>
                      <td><center><a href="{{ asset('/oficinas/editar/'.$oficina->id)}}"><i class="fa fa-edit btn btn-primary btn-xs"></i></a></center></td>
                      <td><center><a data-toggle="modal" data-target="#modal-delete-{{$oficina->id}}"><i class="fa fa-trash-o btn btn-danger btn-xs "></i></a></center></td>
                    </tr>
                    @include('oficinas/modal_oficina')    
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