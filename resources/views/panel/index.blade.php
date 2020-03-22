@extends('theme.lte.layout')
@section('styles')

@endsection
@section('contenido')
<div class="row justify-content-center">
    <div class="col-xl-10 col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <a href="{{route('users.create')}}" class="btn btn-primary">Nuevo Usuario</a>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="card-body" id="users">
                    <div class="table-responsive">
                        @include('pacientes.Notificaciones.notificacionHistorial')
                        <table class="table   text-center table-hover">
                            <thead class="bg-info">
                                <tr>
                                        <th class="text-left">Nombre</th>
                                        <th>Nombre Usuario</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr >
                                    <td class="text-left">{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status}}</td>
                                    <td>
                                        <a href="{{route('users.edit', $user->id)}}" class="btn  btn-warning" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="" class="btn  btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection

