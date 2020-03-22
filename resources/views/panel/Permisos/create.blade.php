@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-uppercase" style="font-family:sans-serif">Nuevo Permiso</h5>
                    </div>
                    <form action="{{route('permisos.store')}}" method="POST">
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug:</label>
                            <input type="text" name="slug" id="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('permisos.index')}}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
