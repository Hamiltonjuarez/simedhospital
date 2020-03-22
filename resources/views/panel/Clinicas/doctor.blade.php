@extends('theme.lte.layout')
@section('contenido')
    <div class="container-fluid">
            @include('pacientes.Notificaciones.notificacionHistorial')
        <div class="row justify-content-center">
            <div class="col-md-7 col-sm-12">
                <form action="{{route('doctores.agregar')}}" id="doctor-add" method="POST">
                    @csrf
                    <input type="hidden" name="clinica_id" value="{{$clinica->id}}">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2 ">
                                    <a href="{{route('clinicas.index')}}" class="btn btn-info">Clinicas</a>
                                </div>
                                <div class="col-md-10 col-sm-12 text-right">
                                    <h5 class="text-uppercase " style="font-family:sans-serif">
                                        añadir doctor a {{$clinica->nombreClinica}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-sm table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Doctor</th>
                                            <th width="90">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nodoctores as $doctor)
                                        <tr>
                                            <td class="text-left">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</td>
                                            <td>
                                                <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                                                <button type="submit" class="btn btn-primary">Añadir</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-uppercase" style="font-family:sans-serif">Quitar doctor</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-left">Doctor</th>
                                        <th width="90">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctores as $doctor)
                                    <tr>
                                        <td class="text-left">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</td>
                                        <td><a href="{{route('doctores.quitar', $doctor->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                document.getElementById('doctor-quitar').submit();">
                                                Quitar
                                            </a>
                                            <form action="{{route('doctores.quitar', $doctor->id)}}" method="POST" id="doctor-quitar">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
