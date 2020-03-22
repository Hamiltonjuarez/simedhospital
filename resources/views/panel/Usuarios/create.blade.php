@extends('theme.lte.layout')
@section('contenido')
    <form action="{{route('users.store')}}" method="POST">
        @csrf
            <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <div class="card shadow-lg p-3 mb-5">
                        <div class="card-header">
                            <h5  style="font-family:sans-serif">
                                NUEVO USUARIO
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is invalid @enderror" autofocus required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email: </label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is invalid @enderror" autofocus required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username: </label>
                                <input type="text" name="username" id="username" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña: </label>
                                <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                                <a href="{{route('users.index')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection
