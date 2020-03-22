<div class="modal fade " id="nuevoMedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4><strong>Agregar Medicamento</strong></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('inventarios.store')}}" method="POST" id="addmedicamento">
                    @csrf                    
                    <input type="hidden" name="doctor_id" value="{{Auth::user()->doctor_id}}">
                    <div class="form-group">
                        <label for="codigomedicamento">Codigo de medicamento: </label> 
                        <input type="text" class="form-control" name="codigomedicamento" id="codigomedicamento" required>   
                    </div> 
                    <div class="form-group">
                        <label for="nombremedicamento">Nombre de medicamento</label>
                        <input type="text" class="form-control" name="nombremedicamento" id="nombremedicamento">
                    </div>
                    <div class="form-group">
                      <label for="consentracionmedicamento">Concentracion de medicamento</label>
                     <div class="row">
                       <div class="col-md-8">
                        <input type="text" class="form-control" name="concentracionc" id="concentracionc">
                       </div>
                       <div class="col">
                          <select name="concentracionm" id="concentracionm" class="form-control" size="1">
                          <option value="Ml" selected>Ml</option>
                          <option value="L" selected>L</option>
                          <option value="Mg" selected>Mg</option>  
                          <option value="G" selected>G</option>                                                                
                          </select>        
                       </div>
                     </div>
                   </div>
                   <input type="hidden" name="concentracion" id="concentracion">
                   <input type="hidden" name="precioiva" id="precioiva">
                   <div class="form-group">
                       <label for="fabricantemedicamento">Fabricante de medicameto</label>
                       <input type="text" class="form-control" name="fabricantemedicamento" id="fabricantemedicamento">
                   </div>
                   <div class="form-group">
                        <label for="stock">Cantidad a ingresar</label>
                        <input type="number" min="0" step="1" class="form-control" name="stock" id="stock">
                   </div>   
                   <div class="form-group">
                     <label for="">Minimo de stock requerido</label>
                     <input type="number" min="0" step="1" class="form-control" name="minimo" id="minimo">
                   </div>
                   <label for="stock">Costo unitario de medicamento</label>               
                   <div class="input-group">                    
                    <div class="input-group-prepend">                    
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="number" min="0" step="0.01" class="form-control" name="costo" id="costo"> 
                  </div>
                  <label for="precio">Porcentaje de utilidad de medicamento</label>
                  <div class="input-group">                    
                    <div class="input-group-prepend">                    
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="number" min="0" step="0.01" class="form-control" name="precio" id="precio">
                  </div>                   
                   <div class="form-group">
                       <label for="fechaexp">Fecha de expiracion de medicamento</label>
                       <input type="date" class="form-control" name="fechaexp" id="fechaexp">
                   </div>                    
            </div>
            <div class="modal-footer">
                    <div class="form-group pull-right">
                        <a href="{{route('inventarios.index')}}" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</a>
                        <button type="button" class="btn btn-sm btn-primary" onclick="envio()" >Guardar Medicamento</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  
    
    
    