@extends('dashboard')

@section('titulo','Tickets')

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
        <h3>Gestión Tickets</h3>
      </div>    
  </div>
  {{-- Fin titulo página --}}
  <div class="clearfix"></div>

  {{-- Inicio formulario --}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tickets <small>Listado Tickets</small></h2><br><br>
            <a href="{{asset('tickets/nuevo_ticket')}}" class="btn btn-primary btn-sm">Nuevo Ticket</a>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
              {{-- Inicio Tabla --}}
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    {{-- <th width="3%">#</th> --}}
                    <th width="5%"># Ticket</th>
                    <th width="20%">Asunto</th>
                    <th width="7%">Tipo de servicio</th>                    
                    <th width="10%">Usuario</th>
                    <th width="10%">Asignado a</th>
                    <th width="3%">Estado</th>
                    <th width="2%"><center>Ver</center></th>
                    <th width="2%"><center>Reabrir</center></th>
                    <th width="2%"><center>Cerrar</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tickets as $i => $ticket)
                    <tr>
                      {{-- <td><center>{{$i+1}}</center></td> --}}
                      <td>{{$ticket->id}}</td>
                      <td>{{$ticket->asunto}}</td>
                      <td>{{$ticket->servicios->nombre}}</td>                      
                      <td>{{$ticket->usuarios->name}}</td>
                      <td> 
                        @if ($ticket->asignado == null)
                          <i>Sin asignar</i>
                        @else
                          {{$ticket->asignado2->name}}
                        @endif
                      </td>
                      <td>{{$ticket->estados->nombre}}</td>
                      <td><center><a href="{{ asset('/tickets/ver/'.$ticket->id)}}"><i class="fa fa-eye btn btn-primary btn-xs"></i></a></center></td>
                      
                      {{-- reabrir ticket --}}
                      @if ($ticket->estado_id == 5)
                        <td><center><a href="" data-toggle="modal" data-target="#modal-reabrir-{{$ticket->id}}"><i class="fa fa-reply btn btn-primary btn-xs"></i></a></center></td>
                        <td><center><a href="" data-toggle="modal" data-target=""><i class="fa fa-close btn btn-default btn-xs" onclick="return false"></i></a></center></td>    
                      @else
                        <td><center><a href="{{ asset('/tickets/editar/'.$ticket->id)}}"><i class="fa fa-reply btn btn-default btn-xs" onclick="return false"></i></a></center></td>  
                        
                        {{--valido para que solo me permita cerrar ticket si este tiene un asignado, es decir si no tiene asignado, no me puede permitir cerrar--}}
                        @if ($ticket->asignado != null) 
                          <td><center><a href="" data-toggle="modal" data-target="#modal-close-{{$ticket->id}}"><i class="fa fa-close btn btn-danger btn-xs "></i></a></center></td>                            
                        @else
                          <td><center><a href="" data-toggle="modal" data-target="" title="Debe estar asignado para poder cerrarse"><i class="fa fa-close btn btn-default btn-xs" onclick="return false"></i></a></center></td>      
                        @endif
                      @endif
                      
                      {{-- cerrar ticket --}}
                      
                    </tr>
                    @include('tickets/modal_cerrar_ticket')
                    @include('tickets/modal_reabrir_ticket')    
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