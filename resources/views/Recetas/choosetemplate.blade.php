@extends('theme.lte.layout')
@section('styles')
    <style>
        .content-template{
            margin-top:10%;
            margin-left:2%;
            margin-right: 2%;
        },

    </style>
@endsection
@section('contenido')
<div class="container justify-content-center">
    <div class="card shadow-lg card-primary card-outline">
        <div class="card-header">
            <h5 class="text-secondary text-uppercase" >
                Elija Una plantilla para la receta
            </h5>
        </div>
        <div class="card-body">
        <div class="row">
                @foreach ($plantillas as $plantilla)
                <div class="col-md-4 col-sm-12 mt-2">
                    <a href="{{route('crearReceta', [$consulta,$paciente,$plantilla->id])}}"><img src="{{ asset('recetas/'.$plantilla->imagen) }}" alt="" width="250" height="300" class="img-thumbnail">
                </a><br></div>
            @endforeach
        </div>
        </div>
    </div>
</div>
@endsection
