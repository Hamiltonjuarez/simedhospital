@extends('theme.lte.layout')
@section('styles')
    <style>
        a .img-res{
            margin: 5px;
            border: 3px solid rgb(150,150,0);
            width: 90%;
            height: 300px;
            
        }
        .text-center {
            font-weight: bold;
            font-size: 16px;
        }
    </style>
@endsection
@section('contenido')
    <div class="row justify-content-md-center">
        <div class="col-md-10 mt-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Modelos de reportes</h3>
                    </div>
                    <!-- /.card-header -->
                    
                    <div class="card body">
                        <div class="row text-center">
                            @foreach ($plantillas as $plantilla)
                                <div class="col-md-4">
                                    <a href="{{ route('procedimiento.generar', [$procedimiento->id, $plantilla->id, $id])}}">
                                            <img src="{{ asset('procedimientos/plantilla/'.$plantilla->plantillaNombre.'.jpg')}}" class="img-res" alt="No image Available">
                                        </a>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="card-footer">
                    </div>
                   
                </div>
                <!-- /.card -->


        </div>
    </div>
@endsection
@section('scripts')
@endsection
