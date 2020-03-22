<section class="container" id="Formicapa">
    <div class="card card-primary card-outline">
        <div class="card-header text-center text-uppercase">
            HOJA DE INCAPACIDAD @isset($paciente) PARA {{$paciente->nombre.' '.$paciente->apellidos}} @endisset
        </div>
        <div class="card-body">
           <form action="{{route('anexos.store')}}" method ="POST" id="formincapacidad" target="_blank" >
                @csrf
                <input type="hidden" name="tipo" value="incapacidad">
           @isset($paciente)<input type="hidden" id="paciente_id" name="paciente_id" value="{{$paciente->id}}">@endisset
           @empty($paciente)
               <div class="form-group">
                   <label for="pacientes">Pacientes<span style="color:red">*</span>:</label>
                   <select name="paciente_id" id="capacidad_id" class="form-control capacidad_id"required>
                       <option value="">Seleccionar paciente</option>
                       @foreach ($pacientes as $paciente)
                             <option value="{{$paciente->id}}">{{$paciente->nombre.''.$paciente->apellidos}}</option>                          
                       @endforeach
                   </select>
                   <span class="text-sm ">Si el paciente no se encuentra en este listado por favor agregarlo <a href="#" class="text-primary" onclick="mostrarModal()">aquí</a></span>
                   <span class="invalid-feedback" role="alert" id="errorpaciente" style="display:none">
                        <strong>¡Por favor seleccione un paciente!</strong>
                    </span>
               </div>
           @endempty
               <div class="form-group">
                   <label for="diagnostico">Diagnóstico:<span style="color:red">*</span></label>
                   <textarea type="text" name="diagnostico" id="diagnosticoinca" rows="5" class="form-control" placeholder="Digite el motivo de incapacidad" required></textarea>
                   <span class="invalid-feedback" role="alert" id="errorsito" style="display:none">
                        <strong>¡El campo es requerido!</strong>
                    </span>
               </div>
               <div class="form-group">
                    <label >Paciente hospitalizado:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hospitalizado" id="sihospi" value="si">
                        <label class="form-check-label" for="sihospi">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hospitalizado" checked id="nohospi" value="no">
                        <label class="form-check-label" for="nohospi">NO</label>
                    </div>
                </div>
               <div id="hospi-hidden" style="display:none">
                    <div class="row form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="ingresodesde">Desde:</label>
                            <input type="text" name="ingresodesde" class="form-control calendar">
                            </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="ingresohasta">Hasta:</label>
                            <input type="text" name="ingresohasta" class="form-control calendar" >
                            </div>
                    </div>
               </div>
               <div class="form-group">
                    <label>Selecionar periodo de incapacidad<span style="color:red">*</span></label>
               </div>
               <div class="row form-group">
                   <div class="col-md-6 col-sm-12">
                       <label for="desde">Desde:</label>
                       <input type="text" name="desde" id="desde" class="form-control calendar" required>
                        <span class="invalid-feedback" role="alert" id="errordesde" style="display:none">
                            <strong>¡El campo es requerido!</strong>
                        </span>
                    </div>
                   <div class="col-md-6 col-sm-12">
                       <label for="hasta">Hasta:</label>
                       <input type="text" name="hasta" id="hasta" class="form-control calendar"  required>
                       <span class="invalid-feedback" role="alert" id="errorhasta" style="display:none">
                            <strong id="mensaje"></strong>
                        </span>
                    </div>
               </div>
               <div class="form-group text-center">
                <button type="reset" class="btn btn-sm btn-secondary">Cancelar</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="enviarincapacidad()">Guardar e imprimir</button>
            </div>
           </form>
        </div>
    </div>
</section>