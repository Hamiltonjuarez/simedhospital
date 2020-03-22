@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Editar Permiso</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('permisos.update', $permiso->id)}}">
                            @csrf
                            <div class="form-group">
                                <label for="nae">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción </label>
                                <input type="text" name="description" id="" class="form-control">
                            </div>
                            <div class="form-group pull-right">
                                <button  class="btn btn-secondary">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
