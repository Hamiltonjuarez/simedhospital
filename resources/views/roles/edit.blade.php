@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-8">
            @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
            <div class="card mt-2">
                <div class="card-header">
                    <span class="card-title">Editar Rol</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="name">Nombre: </label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $role->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripcion: </label>
                            <input type="text" id="description" name="description" class="form-control" value="{{ $role->description }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">slug: </label>
                            <input type="text" id="slug" name="slug" class="form-control" value="{{ $role->slug}}">
                        </div>
                        <h3>Permiso especial</h3>
                        <div class="form-group">
                            <ul>
                                <li>
                                    <label>
                                        <input type="radio" name="special" value="all-access"
                                            @if ($role->special == "all-access")
                                                checked
                                            @endif
                                        > Acceso Total
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="special" value="no-access"
                                            @if ($role->special == "no-access")
                                                checked
                                            @endif
                                        > Ningun Acceso
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="special" value=""
                                            @if ($role->special == "")
                                                checked
                                            @endif
                                        > Ningun permiso especial
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <h3>Lista de Permisos</h3>
                        <div class="form-group">
                            <ul>
                                @foreach ($permisos as $permiso)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" 
                                            @foreach ($permisos_user as $check)
                                                @if ($check->permission_id == $permiso->id)
                                                    checked
                                                @endif
                                            @endforeach
                                            >
                                            {{ $permiso->name }}
                                            <em> ({{ $permiso->description }}) </em>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection