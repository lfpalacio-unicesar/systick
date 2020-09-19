{{-- Inicio modal --}}
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-delete-{{$item->id}}">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Eliminación</h4>
        </div>
        <div class="modal-body">
          <h4>Confirmar eliminación del registro</h4>
          <p>¿Esta seguro que desea eliminar el registro <b>{{$item->nombre}}</b>?</p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a href="{{ asset('/suite/borrar/'.$item->id)}}" class="btn btn-danger">Eliminar</a>
        </div>
      </div>
    </div>
</div>
{{-- Final modal --}}