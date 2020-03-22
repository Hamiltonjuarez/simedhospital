@extends('theme.lte.layout')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title text-center">Tipo de Procedimiento</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($procedimientos as $procedimiento)    
                            <a href="{{ route('procedimiento.plantillas', [$procedimiento->id, $id]) }}" class="btn btn-info btn-block"> {{$procedimiento->procedimiento_nombre}} </a>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
    
@endsection