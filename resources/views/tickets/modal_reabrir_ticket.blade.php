{{-- Inicio modal --}}
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-reabrir-{{$ticket->id}}">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Reabrir Ticket</h4>
        </div>
        <div class="modal-body">
          <h4>Confirmar reapertura del ticket</h4>
          <p>¿Esta seguro que desea reabrir el ticket con asunto <b>{{$ticket->asunto}}</b>?</p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a href="{{ asset('/tickets/reabrir/'.$ticket->id)}}" class="btn btn-primary">Reabrir</a>
        </div>
      </div>
    </div>
</div>
{{-- Final modal --}}