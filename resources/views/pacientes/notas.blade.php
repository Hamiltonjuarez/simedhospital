    <div class="modal fade" id="notas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar notas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('update.notas')}}" method="POST">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="id" value="{{$paciente->id}}">
              <div class="modal-body">
                  <div class="form-group">
                      <textarea class="form-control textarea pacienteNota" id="nota" name="notas"  placeholder="Notas del paciente..." >{!!$paciente->notas!!}</textarea>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
