@extends('theme.lte.layout')
@section('contenido')
<div class="row justify-content-center">
    <div class="col-xl-10 col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col"></div>
                    <div class="col"><h4 class="text-right">Detalles de Usuario</h4></div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Nombre Usuario: </strong>{{ $user->username }}</p>
                <p><strong>Email:</strong> {{$user->email }}</p>
                <p><strong></strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
