<form id="adjuntoss" method="POST" action="{{route('adjuntos.store')}}" enctype="multipart/form-data">
@csrf
<div class="modal fade modal-xl" id="adjunto" tabindex="-1" role="dialog" aria-labelledby="adjuntos" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Subir Archivo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="paciente_id"  value="{{$paciente->id}}">
                <input type="hidden" name="tipodispositivo">
                <input type="hidden" name="tipoarchivo">
                <div class="form-group">
                        <textarea name="descripcion" class="form-control textarea"  rows="10" placeholder="Descripción del adjunto"></textarea>
                        <div class="custom-file mt-4">
                            <input type="file" class="custom-file-input" name="file" id="file" required onchange="showPreview(this.form.file.value)" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                            <label class="custom-file-label" name="file" id="nombrefile" for="labelName">Seleccionar Archivo</label>
                        </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-4">
                    <img src=""  width="100%" height="auto" alt="" id="prueba"/>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
              <div class="form-group">
                  <a href="{{route('pacientes.show', $paciente->id)}}" class="btn btn-secondary btn-sm" >Cancelar</a>
                  <button type="submit" class="btn btn-sm btn-primary " >Guardar</button>
              </div>
          </div>
        </div>
      </div>
</form>
