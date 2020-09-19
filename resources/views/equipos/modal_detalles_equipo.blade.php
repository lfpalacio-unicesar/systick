{{-- Inicio modal --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal-detail-{{$equipo->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel2">Detalles equipo Sticker # {{$equipo->sticker}}</h4>
        </div>
        <div class="modal-body">


            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Nombre Equipo: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->nombre}}</h5>                  
                </div>             
            </div>

            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Ticket Monitor: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->sticker_monitor}}</h5>                  
                </div>             
            </div>

            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Ticket Teclado: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->sticker_teclado}}</h5>                  
                </div>             
            </div>

            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Ticket Mouse: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->sticker_mouse}}</h5>                  
                </div>             
            </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Procesador: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->procesador}}</h5>                  
              </div>             
          </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> RAM: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->ram}}</h5>                  
              </div>             
          </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Disco: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->almacenamiento}}</h5>                  
              </div>             
          </div>

          <div class="row">              
            <div class="col-md-1 col-sm-1 col-xs-1"></div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <h5><b> Dirección IP: </b> </h5>                  
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <h5>{{$equipo->ip}}</h5>                  
            </div>             
        </div>

        <div class="row">              
            <div class="col-md-1 col-sm-1 col-xs-1"></div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <h5><b> Dirección MAC: </b> </h5>                  
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <h5>{{$equipo->mac}}</h5>                  
            </div>             
        </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> S.O: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->sistemas->nombre}}</h5>                  
              </div>             
          </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Antivirus: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->antivirus->nombre}}</h5>                  
              </div>             
          </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Office: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->suites->nombre}}</h5>                  
              </div>             
          </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Software: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  @foreach ($equipo->softwares as $software)
                    <span class="label label-primary">{!! $software->nombre !!}</span>
                  @endforeach                  
              </div>             
          </div>

            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Asignado a: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->asignado}}</h5>                  
                </div>             
            </div>

            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Responsable: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->usuarios->name}}</h5>                  
                </div>             
            </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Fecha compra: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->fcompra}}</h5>                  
              </div>             
          </div>

          <div class="row">              
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <h5><b> Fecha instalación: </b> </h5>                  
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                  <h5>{{$equipo->finstalacion}}</h5>                  
              </div>             
          </div>

          @if ($equipo->estado ==1)

           <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                            <h5><b> Dar baja: </b> </h5>                        
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <a data-toggle="modal" data-target="#modal-delete-{{$equipo->id}}" ><i class="fa fa-trash btn btn-danger btn-xs "></i></a>                        
                        {{-- <a data-dismiss="modal"> <i class="fa fa-trash btn btn-danger btn-xs"></i></a>     --}}
                        {{-- <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Descartar Equipo</button>                  --}}
                    </div>             
                </div>            
          @else
            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Fecha baja equipo: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->fbaja}}</h5>                  
                </div>             
            </div>

            <div class="row">              
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <h5><b> Motivo baja: </b> </h5>                  
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <h5>{{$equipo->motivo_baja}}</h5>                  
                </div>             
            </div>

          @endif
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          {{-- <a href="{{ asset('/oficinas/borrar/'.$oficina->id)}}" class="btn btn-danger">Eliminar</a> --}}
        </div>
      </div>
    </div>
</div>
{{-- Final modal --}}
@include('equipos/modal_eliminar_equipo')