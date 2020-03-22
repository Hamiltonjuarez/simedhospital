@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header" >
                <div class="row">
                    <div class="col"><a class="btn btn-primary" href="{{route('permisos.create')}}">Nuevo permiso</a></div>
                    <div class="col text-right"><h5>Lista de permisos</h5></div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-striped table-hover table">
                        <thead>
                            <tr>
                                <th class=" text-left">NOMBRE</th>
                                <th>SLUG</th>
                                <th>DESCRIPCIÓN</th>
                                <th class=" text-center">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                            <tr>
                                <td class=" text-left">{{$permiso->name}}</td>
                                <td>{{$permiso->slug}}</td>
                                <td>{{$permiso->description}}</td>
                                <td width="90px">
                                    <a class="btn btn-warning" href="{{route('permisos.edit', $permiso->id)}}">Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$permisos->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
