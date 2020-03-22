@extends('theme.lte.layout')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow shadow-lg border border-primary">
                <div class="card-header bg-primary">
                    Editar asistente {{$user->name}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('users.update', $user->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">E-mail</label>
                                <div class="input-group">
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="inputGroupName" value="{{$user->email}}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Nombre</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="inputGroupName" value="{{$user->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                    <label for="username">Nombre de usuario</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" id="username" aria-describedby="inputGroupUsername" value="{{$user->username}}">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-sm" name="password" id="password" aria-describedby="inputGroupNPassword" >
                                </div>
                                <p style="font-size:10px;"><strong>Dejar en blanco si desea la misma contraseña</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="passwordconfirm">Contraseña actual</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-sm" name="passwordconfirm" id="passwordConfirm" aria-describedby="inputGroupNPasswordConfirm">
                                </div>
                                <p style="font-size:10px;"><strong>si desea cambiar contraseña debe escribir su contraseña actual para confirmar</strong></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{route('doctores.profile',Auth::user()->doctor_id)}}" class="btn btn-sm btn-secondary ">Cancelar</a>
                                <button type="submit" class="btn btn-sm btn-primary ">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection