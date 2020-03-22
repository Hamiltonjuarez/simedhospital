@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 d-none d-md-block form-group ">
                                    <a href="{{route('pacientes.index')}}" class="btn btn-sm btn-info"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Lista de pacientes</a>
                                    <a href="{{route('pacientes.show',$paciente)}}" class="btn btn-sm btn-info" id="perfilPaciet"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Perfil paciente</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4>Añadir receta a consulta</h4>
                            
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <form id="formReceta" action="{{route('guardarReceta')}}" method="POST" target="_blank">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="plantilla_id" value="{{$template->id}}">
                        <input type="hidden" id="consulta_id" name="consulta_id" value="{{$consulta}}">
                        <input type="hidden" id="paciente_id" name="paciente_id" value="{{$paciente}}">
                        <div class="form-group">
                                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo de la receta">
                            </div>
                                    <div class="form-group">
                                      <textarea class="form-control textarea recetaMedica" id="receta" name="receta"  placeholder="Receta..."></textarea>
                                    </div>
                                    <br>
                                    <div class="form-group pull-right">
                                        <a href="{{route('pacientes.show',$paciente)}}" class="btn btn-sm btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-sm btn-info" name="imprimir" onclick="enviar()">Imprimir Receta</button>
                                        <button type="button" class="btn btn-sm btn-primary " name="guardar" onclick="event.preventDefault();document.getElementById('formReceta').removeAttribute('target');document.getElementById('formReceta').submit();"> Guardar</button>
                                    </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
   $(function () {
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5({
            toolbar: { fa: true,
                "image" : false,
                "link" : false,
                "font-styles" : false,
            },
            useLineBreaks : true,
        })
    });


    function enviar(){
        document.getElementById('formReceta').setAttribute('action', "{{route('recetas.printreceta')}}");
        var formRece = document.getElementById('formReceta').submit();
        window.location = "{{route('pacientes.show',  $paciente)}}";
    }
</script>
@endsection
