@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary mt-1">
                <div class="card-header">
                    <h2 class="card-title">Cuenta</h2>
                </div>
                <div class="card-body">
                    <form action="">
                        nombre de usuario: <input type="text" name="" class="form-control" id="" value="{{ $usuario->name }}"> <br>
                        email: {{ $usuario->email }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('scripts')
    
@endsection