<form action="{{route('pacientes.destroy',$pacientes->id)}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <div class="modal fade eliminarPaciente" tabindex="-1" role="dialog" aria-labelledby="eliminarPaciente" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong>Eliminar Paciente</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <h4>¿Esta seguro que desea eliminar a: {{$pacientes->nombre}} ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit"  class="btn btn-danger btn-sm float-right">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>
