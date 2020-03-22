<div class="modal fade " id="editarmedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
            <h4><strong>Editar Medicamento</strong></h4>      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('inventarios.editarmedicamento')}}" method="POST" id="editmedicamento">
            @csrf                    
              <input type="hidden" name="doctor_id" value="{{Auth::user()->doctor_id}}">
              <input type="hidden" name="medicamento_idedit" id="medicamento_idedit" value="">
            <div class="form-group">
                <label for="codigomedicamento">Codigo de medicamento </label> 
                <input type="text" class="form-control" name="codigoedit" id="codigoedit">   
            </div> 
            <div class="form-group">
                <label for="codigomedicamento">Nombre de medicamento </label> 
                <input type="text" class="form-control" name="nombreedit" id="nombreedit">   
            </div>            
            <div class="form-group">
                <label for="codigomedicamento">Consentracion de medicamento </label> 
                <input type="text"  class="form-control" name="concentracionedit" id="concentracionedit">   
            </div> 
            <div class="form-group">
                <label for="nombremedicamento">Fabricante</label>
                <input type="text" class="form-control" name="fabricanteedit" id="fabricanteedit">
            </div>
            <div class="form-group">
                <label for="nombremedicamento">Stock de medicamento</label>
                <input type="number" class="form-control" name="stockedit" id="stockedit">
            </div>    
            <div class="form-group">
              <label for="">Minimo de inventario de medicamento</label>
              <input type="number" name="minimo" class="form-control" id="minimoedit">
            </div>
            <label for="costoedit">Costo de medicamento </label> <br>
            <div class="input-group">                
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">$</span>
                  </div>               
                <input type="number" min="0" step="1" class="form-control" name="costoedit" id="costoedit">   
            </div>
             <label for="codigomedicamento">precio de medicamento </label> 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                <input type="number" min="0" step="1" class="form-control" name="precioedit" id="precioedit">   
            </div>                   
            <div class="form-group">
              <label for="fechaexp">Fecha de expiracon de medicamento</label>
              <input type="date" class="form-control" name="fechaexpedit" id="fechaexp1edit">
          </div>  
          <input type="hidden" value="" name="precioivaedit" id="precioivaedit">                    
        </div>
        <div class="modal-footer">
                <div class="form-group pull-right">
                    <a href="{{route('inventarios.index')}}" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</a>
                    <button type="button" class="btn btn-sm btn-primary" onclick="editarmed()" >Editar medicamento</button>
                </div>
     </form>
        </div>
      </div>
    </div>
 </div>