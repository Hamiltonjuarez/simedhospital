@extends('theme.lte.layout')
@section('contenido')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2>Deatalle de Receta</h2>
                    </div>
                    <div class="card-body">
                    <h3>{{$receta->tituloReceta}}</h3><br>
                    {!!$receta->descripcionReceta!!}

                    <div class="form-group pull-right">
                            <a href="{{route('pacientes.index')}}" class="btn btn-secondary btn-sm ">Cancelar</a>
                            <a href="{{route('imprimirReceta', $receta->id)}}" class="btn btn-sm btn-primary " target="_blank">Imprimir</a>

                    </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
