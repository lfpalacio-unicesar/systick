@extends('dashboard')

@section('titulo','Notificaciones')

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
  {{-- fin bloque mensajes --}}
  
  {{-- Titulo de página  --}}
  <div class="page-title">
      <div class="title_left">
        <h3>Consulta Notificaciones</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Notificaciones <small>Listado Notificaciones</small></h2><br><br>
            <a href="{{asset('tickets/nuevo_ticket')}}" class="btn btn-primary btn-sm">Nuevo Ticket</a>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
              {{-- Inicio Tabla --}}
              <table id="datatable-buttons" class="table table-striped table-bordered newTable">
                <thead>
                  <tr>
                    {{-- <th width="3%">#</th> --}}
                    <th width="68%"> Mensaje</th>
                    <th width="13%"><center>Titular</center></th>
                    <th width="12%"><center>Fecha</center></th>
                    <th width="5%">Visto</th>
                    {{-- <th width="5%">Ver ticket</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($notificaciones as $i => $noti)
                    <tr>
                      {{-- <td><center>{{$i+1}}</center></td> --}}
                      <td>{!!$noti->mensaje!!}</td>
                      <td><center>{{$noti->persona}}</center></td>
                      <td><center>{{$noti->created_at}}</center></td>
                      <td>
                          @if ($noti->visto == 1)
                            <center><a href="{{ asset('/tickets/ver/notificacion/'.$noti->ticket_id.'/'.$noti->id) }}"><i class="fa fa-folder-open btn btn-primary btn-xs" title="Leido"></i></a></center>    
                          @else
                            <center><a href="{{ asset('/tickets/ver/notificacion/'.$noti->ticket_id.'/'.$noti->id) }}"><i class="fa fa-folder btn btn-danger btn-xs" title="Sin leer"></i></a></center>  
                          @endif
                      </td>
                      {{-- <td><center><a href="{{ asset('/tickets/ver/'.$noti->ticket_id)}}"><i class="fa fa-eye btn btn-primary btn-xs"></i></a></center></td>                      --}}
                    </tr>
                    {{-- @include('tickets/modal_cerrar_ticket')
                    @include('tickets/modal_reabrir_ticket')     --}}
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
    
  {{-- <script>
    $('.newTable').DataTable({
      "aaSorting": [],
      language: 
      {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
      }
    });
  </script> --}}

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
    
    
@endsection