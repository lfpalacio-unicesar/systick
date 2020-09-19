@extends('dashboard')

@section('titulo','Bitácora')

@section('content')
    {{-- Titulo de página  --}}
    <div class="page-title">
        <div class="title_left">
        <h3>Bitácora</h3>
        </div>    
    </div>
    {{-- Fin titulo página --}}
    <div class="clearfix"></div>

    {{-- Inicio formulario --}}
  <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Bitácora <small>Historico de transacciones en sistema</small></h2><br><br>
              {{-- <a href="{{asset('/equipos/nuevo_equipo')}}" class="btn btn-primary btn-sm">Nuevo Equipo</a> --}}
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br/>
              <form action="{{asset('/bitacora/consultar')}}" method="POST" role="form">
                   {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <label for="" class="control-label">Registros</label>
                            <input type="number" name="cantidad" class="form-control" style="width:70px" value="{{old('cantidad')}}">
                            {{-- <br>
                            <label for="" class="control-label">Usuario</label>
                            <input type="text" name="usuario" class="form-control"> --}}
                            
                        </div>    
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label for="" class="control-label">Fecha inicio</label>
                            <input type="date" name="finicio" class="form-control" value="{{ @$finicio }}">
                            <br>
                            <label for="" class="control-label">Fecha final</label>
                            <input type="date" name="ffinal" class="form-control" value="{{ @$ffinal }}">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label for="" class="control-label">Texto</label><br>
                            <textarea name="texto" id="" style="width:320px" rows="5">{{ @$texto }}</textarea>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <br>
                            <button type="submit" class="btn btn-primary ">Buscar</button>
                        </div>
                    </div>  
                    <br>

                    <div class="row">
                      <br><hr>
                      @if ($bitacora==null)
                          
                      @else
                        {{-- Inicio Tabla --}}
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th width="2%"><center>#</center></th>
                              <th width="10%"><center>Fecha - Hora</center></th>
                              <th width="10%"><center>Usuario</center></th>
                              <th width="35%">Acción</th>
                              <th width="10%">Ip</th>                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($bitacora as $i => $item)
                              <tr>
                                  <td><center>{{$i+1}}</center></td>
                                  <td><center>{{$item->created_at}}</center></td>
                                  <td><center>{{$item->users->name}}</center></td>
                                  <td>{!!$item->accion!!}</td>
                                  <td><center>{{$item->ip}}</center></td>                                                                    
                              </tr>                           
                            @endforeach                            
                          </tbody>  
                        </table>
                        {{-- Fin tabla --}}
                      @endif
                    </div>
                </form>
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
    
    {{-- <script>      
        // Disable search and ordering by default
        $.extend( $.fn.dataTable.defaults, {
            //ordering:  false
            "order":[[1,"desc"]]
        } );
    </script>   --}}

    <script>      
      // Disable search and ordering by default
      $.extend( $.fn.dataTable.defaults, {                    
          language:{
          url: "{{ asset('gentelella/vendors/datatables.net/Spanish.json') }}" 
          }
      } );
    </script>

@endsection
