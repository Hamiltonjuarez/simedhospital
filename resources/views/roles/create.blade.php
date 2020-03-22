@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-8">
            @if (session('info'))
                <div class="alert" class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
            <div class="card mt-2">
                <div class="card-header">
                    <span class="card-title">Crear Rol</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre: </label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripcion: </label>
                            <input type="text" id="description" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slug">slug: </label>
                            <input type="text" id="slug" name="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection