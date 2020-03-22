<section class="container" id="Formalta">
    <div class="card card-primary card-outline">
        <div class="card-header text-center text-uppercase">
            HOJA DE ALTA @isset($paciente) PARA {{$paciente->nombre.' '.$paciente->apellidos}} @endisset
        </div>
        <div class="card-body">
            <form action="{{route('anexos.store')}}" method="POST" id="formcreatealta" target="_blank">
                @csrf
                <input type="hidden" name="tipo" value="alta">
                @isset($paciente) <input type="hidden" name="paciente_id" value="{{$paciente->id}}">@endisset
                @empty($paciente)
                <div class="form-group">
                    <label for="pacientes">Pacientes <span style="color:red">*</span>:</label>
                    <select class="form-control capacidad_id" name="paciente_id" id="pacientes" required>
                        <option selected value="">Seleccionar paciente</option>
                        @foreach ($pacientes as $paciente)
                        <option value="{{$paciente->id}}">{{$paciente->nombre.' '.$paciente->apellidos}}</option>
                        @endforeach
                    </select>
                </div>
                @endempty
                <div class="form-group">
                    <label for="">Diagnóstico <span style="color:red">*</span>:</label>
                    <textarea name="diagnostico" id="diagnosticoalta"  class="form-control" rows="5" placeholder="Diagnóstico del paciente"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Tratamiento:</label>
                    <textarea name="tratamiento" id="tratamiento" class="form-control" rows="5" placeholder="Tratamiento para el paciente"></textarea>
                </div>
                <label for="" >Estado del paciente <span style="color:red">*</span>:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline" >
                        <input class="form-check-input estado" type="radio" name="estado_alta" id="curado" value="Curado" required>
                        <label class="form-check-label labels" for="curado">Curado</label>
                    </div>
                    <div class=" form-check form-check-inline" >
                        <input class="form-check-input float-right estado" type="radio" checked name="estado_alta" id="mejorado" value="Mejorado" required>
                        <label class="form-check-label labels" for="mejorado">Mejorado</label>
                    </div>
                    <div class=" form-check form-check-inline" >
                            <input class="form-check-input float-right estado" type="radio" name="estado_alta" id="alta" value="paciente pidio alta" required>
                            <label class="form-check-label labels" for="alta">Paciente pidió alta</label>
                        </div>
                    <div class="form-check form-check-inline" >
                        <input class="form-check-input float-right estado" type="radio" name="estado_alta" id="igual" value="Igual" required>
                        <label class="form-check-label labels" for="igual">Igual</label>
                    </div>
                    <div class=" form-check form-check-inline" >
                        <input class="form-check-input float-right estado" type="radio" name="estado_alta" id="muerto" value="muerto" required>
                        <label class="form-check-label labels" for="muerto">Muerto</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Otras instrucciones:</label>
                    <textarea name="agregados" id="agregados"  class="form-control" rows="5" placeholder="Información extra"></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="reset" class="btn btn-sm btn-secondary">Cancelar</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="enviaralta()">Guardar e imprimir</button>
                </div>
            </form>
        </div>
    </div>
</section>