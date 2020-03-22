<div class="modal fade " id="agregarstock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4><strong>Agregar Medicamento</strong></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('entradainventarios.store')}}" method="POST" id="addstock">
            @csrf                    
              <input type="hidden" name="doctor_id" value="{{Auth::user()->doctor_id}}">
              <input type="hidden" name="medicamento_id" id="medicamento_id" value="">           
            <div class="form-group">
                <label for="codigomedicamento">Cantidad de medicamento a ingresar </label> 
                <input type="number" min="0" step="1" class="form-control" name="cantidad" id="cantidad">   
            </div> 
            <div class="form-group">
                <label for="nombremedicamento">Proveedor</label>
                <input type="text" class="form-control" name="proveedor" id="proveedor">
            </div>                  
            <div class="form-group">
                <label for="fechain">Fecha de ingreso de pedido</label>
                <input type="date" class="form-control" name="fechain" id="fechain">
            </div>
            <div class="form-group">
              <label for="fechaexp">Fecha de expiracon de medicamento</label>
              <input type="date" class="form-control" name="fechaexp" id="fechaexp1">
          </div>                      
        </div>
        <div class="modal-footer">
                <div class="form-group pull-right">
                    <a href="{{route('inventarios.index')}}" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</a>
                    <button type="button" class="btn btn-sm btn-primary" onclick="probando()" >Agregar pedido</button>
                </div>
            </form>
        </div>
      </div>
    </div>
 </div>

    