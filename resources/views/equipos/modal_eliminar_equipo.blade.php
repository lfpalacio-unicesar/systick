{{-- Inicio modal --}}
<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true" id="modal-delete-{{$equipo->id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Confirmación baja de equipos</h4>
        </div>
        <div class="modal-body">
          {{-- <h4>Confirmar descarte del equipo</h4> --}}
          <p>¿Esta seguro que desea dar de baja el equipo con Sticker # <b>{{$equipo->sticker}}</b>?</p>
          <p style="color:red">*Tenga presente que la acción <b>dar de baja</b> no es reversible en el sistema.</p>
            <form action="{{asset('/equipos/borrar')}}" method="POST">
              {{ csrf_field() }}
              <label for="">Motivo baja equipo</label>
              {{-- <input type="text"  rows="3" > --}}
              <textarea class="form-control" name="motivo_baja" id="motivo_baja" cols="30" rows="3" required="required"></textarea>
              <input type="hidden" name="fbaja" value="{{date('Y-m-d')}}">
              <input type="hidden" name="estado" value="0">
              <input type="hidden" name="id2" value="{{$equipo->id}}">
            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                {{-- <a href="{{ asset('/oficinas/borrar/'.$equipo->id)}}" class="btn btn-danger">Descartar</a> --}}
                <button type="submit" class="btn btn-danger">Dar baja</button>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Final modal --}}