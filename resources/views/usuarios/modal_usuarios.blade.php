{{-- Inicio modal --}}
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-delete-{{$usuario->id}}">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          @if ($usuario->estado==1)
            <h4 class="modal-title" id="myModalLabel2">Inactivación</h4>    
          @else
            <h4 class="modal-title" id="myModalLabel2">Activación</h4>  
          @endif
          
        </div>
        <div class="modal-body">
          @if ($usuario->estado==1)
            <h4>Confirmar inactivación del usuario</h4>
            <p>¿Esta seguro que desea inactivar el usuario <b>{{$usuario->username}}</b>?</p>    
          @else
            <h4>Confirmar activación del usuario</h4>
            <p>¿Esta seguro que desea activar el usuario <b>{{$usuario->username}}</b>?</p>
          @endif
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          @if ($usuario->estado==1)
            <a href="{{ asset('/usuarios/activar/'.$usuario->id)}}" class="btn btn-danger">Inactivar</a>    
          @else
            <a href="{{ asset('/usuarios/activar/'.$usuario->id)}}" class="btn btn-primary">Activar</a>
          @endif
          
        </div>
      </div>
    </div>
</div>
{{-- Final modal --}}