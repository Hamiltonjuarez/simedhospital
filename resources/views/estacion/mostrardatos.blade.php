<div class="modal fade " id="mostrardatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="text-center"><strong>Personal Medico Asignado </strong><i class="fa fa-user-md"></i></h4>      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         @isset($doctor)
          <h3>Doctor: <u> {{$doctor}}</u></h3> <br>
         @endisset
        @isset($anestesista)
         <h3>Anestesiólogo: <u> {{$anestesista}}</u></h3><br>
        @endisset
        @isset($primer)
          <h3>Primer Auxiliar: <u> {{$primer}}</u></h3><br>
        @endisset
        @isset($segundo)
          <h3>Segundo Auxiliar: <u> {{$segundo}}</u></h3><br>
        @endisset
        @isset($instrumentista)
           <h3>Instrumentista: <u> {{$instrumentista}}</u></h3><br>
        @endisset
       @isset($circular)
          <h3>Circular: <u> {{$circular}}</h3></u><br>
       @endisset
        </div>
        <div class="modal-footer">
                <div class="form-group pull-right">
                    <a  class="btn btn-lg btn-secondary" style="color:white" data-dismiss="modal">Cerrar</a>
                    <button type="button" onclick="editarpersonal()" data-dismiss="modal" class="btn btn-lg btn-primary">Editar personal</button>
                </div>
    
        </div>
      </div>
    </div>
 </div>