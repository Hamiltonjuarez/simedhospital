<div class="modal fade " id="modaleditarpaquete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
            <h4><strong>Editar Medicamento</strong></h4>      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('inventarios.editarpaquete')}}" method="POST" id="editarpaquete">
            @csrf            
              <input type="hidden" name="idpaqueteditar" id="idpaqueteditar" value="">
            <div class="form-group">
                <label for="codigomedicamento">Nombre del paquete: </label> 
                <input type="text" class="form-control" name="nombrepaqueteeditar" id="nombrepaqueteeditar">   
            </div> 
            <label for="stock">Costo del paquete</label>               
                   <div class="input-group">                    
                    <div class="input-group-prepend">                    
                     <div class="input-group-text">$</div>
                    </div>
                    <input type="number" min="0" step="0.01" class="form-control" name="costopaquete" id="costopaquete"> 
                  </div>         
                  <label for="stock">Costo del paquete</label>               
                  <div class="input-group">                    
                   <div class="input-group-prepend">                    
                    <div class="input-group-text">$</div>
                   </div>
                   <input type="number" min="0" step="0.01" class="form-control" name="preciopaquete" id="preciopaquete"> 
                 </div>                         
        </div>
        <div class="modal-footer">
                <div class="form-group pull-right">
                    <a href="{{route('inventarios.index')}}" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</a>
                    <button type="button" onclick="enviarpaqueteaeditar()"  class="btn btn-sm btn-primary">Editar paquete</button>
                </div>
     </form>
        </div>
      </div>
    </div>
 </div>