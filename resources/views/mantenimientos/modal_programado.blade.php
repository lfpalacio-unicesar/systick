{{-- Inicio modal --}}
@if ($item->fprogramada == null)    
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-update-{{$item->id}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
    
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel2">Actualizar fecha</h4>
            </div>
            <div class="modal-body">
              <h4><center>Nueva fecha programada para mantenimiento # <b>{{$item->id}}</b></center></h4>
              <br>
              {{-- <p>¿Esta seguro que desea actualizar la fecha de mantenimiento programada para el mantenimiento # <b>{{$item->id}}</b> ?</p> --}}
              
              <form action="{{ asset('/mantenimientos/fprogramada') }}" method="POST">
                  {{ csrf_field() }}                  
                  <input type="date" name="fprogramada" id="fprogramada" class="form-control" required>
                  <input type="hidden" name="id" value="{{$item->id}}">              
              <br>
              <p style="color:red"><i>Una vez actualizada la fecha programada de mantenimiento, esta <u>no se podrá modificar más</u>.</i></p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              {{-- <a href="{{ asset('/servicios/borrar/'.$item->id)}}" class="btn btn-danger">Actualizar</a> --}}
              <button type="submit" class="btn btn-danger">Actualizar</button>
            </form>
            </div>
          </div>
        </div>
    </div>
@endif
    {{-- Final modal --}}