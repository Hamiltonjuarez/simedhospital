@extends('theme.lte.layout')
@section('styles')
<link rel="stylesheet" href="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.css")}}">
@endsection
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header text-center text-uppercase">
                       EDITAR DATOS DE HOJA DE ALTA PARA EL PACIENTE {{$paciente->nombre.' '.$paciente->apellidos}}
                    </div>
                    <form action="{{route('anexos.update', $anexo->id)}}" method="POST" id="formeditanexo" target="_blank">
                        <div class="card-body">  
                            @csrf
                            <input type="hidden" name="_method" value="PUT">            
                            <div class="form-group">
                                <label for="diagnostico">Diagnóstico: </label>
                                <textarea name="diagnostico" id="diagnostico"  class="form-control" rows="5" >{{$anexo->diagnostico}}</textarea>
                            </div>
                            @if($anexo->tipo == 'alta')
                            <div class="form-group">
                                <label for="tratamiento">Tratamiento: </label>
                                <textarea name="tratamiento" id="tratamiento" class="form-control" rows="5" >{{$anexo->tratamiento}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado de paciente : </label> 
                            </div>         
                            <div class="form-group">
                                <div class="form-check form-check-inline" >
                                    <input class="form-check-input estado" type="radio" name="estado_alta" id="curado" value="Curado" @if($anexo->estado_alta == 'Curado') checked @endif required>
                                    <label class="form-check-label labels" for="curado">Curado</label>
                                </div>
                                <div class=" form-check form-check-inline" >
                                    <input class="form-check-input float-right estado" type="radio" name="estado_alta" id="mejorado" value="Mejorado" @if($anexo->estado_alta == 'Mejorado') checked @endif required>
                                    <label class="form-check-label labels" for="mejorado">Mejorado</label>
                                </div>
                                <div class=" form-check form-check-inline" >
                                        <input class="form-check-input float-right estado" type="radio" name="estado_alta" id="alta" value="paciente pidio alta" @if($anexo->estado_alta == 'paciente pidio alta') checked @endif required>
                                        <label class="form-check-label labels" for="alta">Paciente pidió alta</label>
                                    </div>
                                <div class="form-check form-check-inline" >
                                    <input class="form-check-input float-rightestado" type="radio" name="estado_alta" id="igual" value="Igual"  @if($anexo->estado_alta == 'Igual') checked @endif required>
                                    <label class="form-check-label labels" for="igual">Igual</label>
                                </div>
                                <div class=" form-check form-check-inline" >
                                    <input class="form-check-input float-right estado" type="radio" name="estado_alta" id="muerto" value="muerto" @if($anexo->estado_alta == 'muerto') checked @endif required>
                                    <label class="form-check-label labels" for="muerto">Muerto</label>
                                </div>
                                <div class=" form-check form-check-inline">
                                    <input class="form-check-input float-right " name="estado_alta" type="radio"  id="otro"  value="otro" @if($anexo->estado_alta == 'otro') checked @endif >
                                    <label class="form-check-label labels" for="otro">Otro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Otras instrucciones:</label>
                                <textarea name="agregados" id="agregados"  class="form-control" rows="5">{{$anexo->agregados}}</textarea>
                            </div>
                            @endif
                            @if($anexo->ingresodesde != null)
                            <div class="row form-group">
                                <div class="col-md-6 col-sm-12">
                                    <label for="ingresodesde">Desde:</label>
                                    <input type="text" name="ingresodesde" id="ingresodesde" class="form-control calendar">
                                    </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="ingresohasta">Hasta:</label>
                                    <input type="text" name="ingresohasta" id="ingresohasta" class="form-control calendar" >
                                    </div>
                            </div>
                            @endif
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
                                <button type="button" class="btn btn-sm btn-secondary" onclick="window.location='{{route('pacientes.show', $paciente->id)}}'">Cancelar</button>
                                <button type="button" class="btn btn-sm btn-primary" onclick="envioeditanexo()">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.js")}}"></script>
<script>
    var desde = "{{$anexo->desde}}";
    var hasta =  "{{$anexo->hasta}}";
    var ingresodesde = "{{$anexo->ingresodesde}}";
    var ingresohasta = "{{$anexo->ingresohasta}}";

    $('#desde').datetimepicker({
        format: 'YYYY-MM-DD',
        date: moment(desde).format(),
    });
    $('#hasta').datetimepicker({
        format: 'YYYY-MM-DD',
        date: moment(hasta).format(),
    });
    $('#ingresodesde').datetimepicker({
        format: 'YYYY-MM-DD',
        date: moment(ingresodesde).format(),
    });
    $('#ingresohasta').datetimepicker({
        format: 'YYYY-MM-DD',
        date: moment(ingresohasta).format(),
    });

    function envioeditanexo()
    {
        if($("#diagnostico").val().length>0)
        {
            document.getElementById("formeditanexo").submit();
            window.location = "{{route('pacientes.show', $paciente->id)}}";
        }else{
            $("#diagnostico").focus();
            $("#diagnostico").addClass("is-invalid");
            toastr.error("El diagnóstico es requerido")
        }
    }
</script>
@endsection
