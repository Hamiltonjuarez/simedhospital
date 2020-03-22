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
                    <span class="card-title">Roles</span>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary pull-right">Crear</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        @foreach ($roles as $rol)
                            <tr>
                                <td>
                                    {{ $rol->name }}
                                </td>
                                <td width="10px">
                                    <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-default btn-sm">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('roles.destroy', $rol->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection