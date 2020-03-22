@extends('theme.lte.layout')
@section('contenido')
<div class="container">
    <div class="row justify-content-center" id="asistenteIndex">
        <div class="col-md-8 col-xs-12">
            <div class="card ">
                <div class="card-header">
                    <h5 class="card-title">Listado de Asistentes</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover  table-striped text-center">
                        <thead class="bg-info">
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asistentes as $asistente)
                                <tr>
                                    <td>{{$asistente->name}}</td>
                                    <td>{{$asistente->username}}</td>
                                    <td>{{$asistente->email}}</td>
                                    <td>{{$asistente->status}}</td>
                                    <td >
                                        <a  class="btn  btn-primary" href="{{route('doctores.agregar-asistente', ['asistente' => $asistente->id, $doctor])}}"  role="button">Añadir&nbsp;&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Asistentes Asignadas</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($asistentes_doctor as $item)
                            <li class="list-group-item">
                                {{$item->name}}  <button class="btn btn-danger pull-right" onclick="event.preventDefault();document.getElementById('deleteAsistente').submit();">Eliminar <i class="fa fa-trash" aria-hidden="true"></i></button></li>
                            <form id="deleteAsistente" action="{{ route('doctores.quitarasistente', $asistente->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                            </form>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')

@endsection