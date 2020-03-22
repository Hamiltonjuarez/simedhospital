@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-6">
            <div class="card mt-2 card-info">
                <div class="card-header">
                    <h3 class="card-title">Doctor</h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" nombre="nombreDoctor" id="nombreDoctor" class="form-control"
                                    value="{{ $doctor->nombreDoctor }}" placeholder="nombreDoctor">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" nombre="apellidosDoctor" id="apellidosDoctor" class="form-control"
                                    value="{{ $doctor->apellidosDoctor }}" placeholder="apellidosDoctor">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="nacimiento" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="especialidad">Especialidad : </label>
                            <input type="text" nombre="especialidad" id="especialidad" class="form-control"
                            value="{{ $doctor->especialidad }}">
                        </div>
                        <div class="form-group">
                                <label for="direccion">direccion : </label>
                                <input type="text" nombre="direccion" id="direccion" class="form-control"
                                value="{{ $doctor->direccion }}">
                            </div>
                        <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="apellidosDoctor">telefono : </label>
                                        <input type="text" nombre="apellidosDoctor" id="apellidosDoctor" class="form-control"
                                        value="{{ $doctor->apellidosDoctor }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="apellidosDoctor">Correo electronico : </label>
                                        <input type="text" nombre="apellidosDoctor" id="apellidosDoctor" class="form-control"
                                        value="{{ $doctor->apellidosDoctor }}">
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-lg-10 col-xl-6">
            <div class="card mt-2 card-info">
                <div class="card-header">
                    Asitentes disponibles
                </div>
                <div class="card-body">
                    @foreach ($asistentes as $asistente)
                        <p>{{$asistente->name}}</p>
                    @endforeach
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('scripts')
    
@endsection