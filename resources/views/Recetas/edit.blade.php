@extends('theme.lte.layout')
@section('styles')
    <style>
    .img-pointer{
        cursor: pointer;
        width: 100%;
        height: 200px;
    },


    </style>
@endsection
@section('contenido')
<div class="container" id="editreceta">
    <form action="{{route('recetas.update', $receta->id)}}" method="POST" id="recetaedit-form" target="_blank">
    @csrf
    <input type="hidden" name="_method" value="PUT">
        <div class="card shadow-lg card-primary card-outline">
            <div class="card-header text-uppercase" >
                Editar receta @isset($paciente)de {{$paciente->nombre.' '.$paciente->apellidos}}@endisset
            </div>
            <div class="card-body border-bottom">
                <div class="form-group border-bottom">
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="plantilla_id" id="plantilla1" value="1" @if($receta->plantilla_id == 1) checked @endif style="display:none">
                                <label class="form-check-label" for="plantilla1" title="Seleccionar"><img src="{{asset('recetas/plantilla1.png')}}" alt=""   class="img-pointer" ></label>
                                <p class="text-center" id="pp1" >PLANTILLA 1</p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="plantilla_id" id="plantilla2" value="2" @if($receta->plantilla_id == 2)checked @endif style="display:none" >
                                <label class="form-check-label" for="plantilla2" title="Seleccionar"><img src="{{asset('recetas/plantilla2.png')}}" alt=""  class=" img-pointer"></label>
                                <p class="text-center" id="pp2" >PLANTILLA 2</p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="plantilla_id" id="plantilla3" value="3" @if($receta->plantilla_id == 3)checked @endif style="display:none" >
                                <label class="form-check-label" for="plantilla3" title="Seleccionar"><img src="{{asset('recetas/plantilla3.png')}}" alt=""  class="img-pointer"></label>
                                <p class="text-center" id="pp3" >PLANTILLA 3</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" name="tituloReceta" id="titulo" value="{{$receta->tituloReceta}}" required>
                </div>
                <div class="form-group">
                    <label for="receta">Descripción de la receta:</label>
                    <textarea class="form-control textarea receta" id="receta" name="descripcionReceta" rows="15"  required>{!!$receta->descripcionReceta!!}</textarea>
                </div>
                <div class="form-group text-center">
                    @if($receta->paciente_id != null)
                        <a href="{{route('pacientes.show', $receta->paciente_id)}}" class="btn btn-sm btn-secondary">Cancelar</a>
                    @else
                        <a href="{{route('recetas.index')}}">Cancelar</a>
                    @endif
                    <button type="button" class="btn btn-sm btn-primary" onclick="printreceta()">Imprimir</button>
                    <button type="submit" class="btn btn-sm btn-primary" onclick="event.preventDefault();document.getElementById('recetaedit-form').removeAttribute('target');document.getElementById('recetaedit-form').submit()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script>
        window.onload = function() {
            document.getElementById("titulo").focus();
        };
    document.addEventListener('DOMContentLoaded', (event) => {
        $(function(){
            $('.textarea').wysihtml5({
                toolbar: { fa: true,
                    "image" : false,
                    "link" : false,
                    "font-styles" : false,
                },
                useLineBreaks : true,
            });
        });
        
        if($('#plantilla1').prop('checked')){
            $('#pp1').addClass('bg-primary')
        }else if($('#plantilla2').prop('checked'))
        {
            $('#pp2').addClass('bg-primary');
        }else if($('#plantilla3').prop('checked'))
        {
            $('#pp3').addClass('bg-primary')
        }

        $('#plantilla1').click(function(){
            $('#pp1').addClass('bg-primary');
            $('#pp2').removeClass('bg-primary');
            $('#pp3').removeClass('bg-primary');
        });
        $('#plantilla2').click(function(){
            $('#pp2').addClass('bg-primary');
            $('#pp1').removeClass('bg-primary');
            $('#pp3').removeClass('bg-primary');
        });
        $('#plantilla3').click(function(){
            $('#pp3').addClass('bg-primary');
            $('#pp2').removeClass('bg-primary');
            $('#pp1').removeClass('bg-primary');
        });
    });

    function printreceta(){
        document.getElementById('recetaedit-form').removeAttribute('action');
        document.getElementById('recetaedit-form').setAttribute('action', "{{route('recetas.printedit', $receta->id)}}");
        var formedit = document.getElementById('recetaedit-form').submit();
        @isset($paciente) 
            window.location = "{{route('pacientes.show', $paciente->id)}}"; 
        @endisset
        @empty($paciente)
            window.location = "{{route('nuevaReceta')}}"; 
        @endempty

    }

  
    </script>
@endsection