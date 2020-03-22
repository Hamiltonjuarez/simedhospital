@extends('theme.lte.layout')
@section('contenido')

<form  action="{{ route('doctores.store') }}" method="POST" >
        @csrf

        <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <div class="card shadow-lg p-3 mb-5">
                    <div class="card-header">
                    <h5 class="text-uppercase">Crear Doctor para el usuario {{$user->name}}</h5>

                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col">
                                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="nombreDoctor" required placeholder="Nombre del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="apellidosDoctor" required placeholder="Apellidos del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <div class="col form-check form-check-inline" >
                                    <input class="form-check-input " type="radio" name="sexo" id="sexoHombre" value="hombre" required>
                                    <label class="form-check-label" for="sexoHombre">Hombre</label>&nbsp;
                                    <input class="form-check-input float-right " type="radio" name="sexo" id="sexoMujer" value="mujer" required>
                                    <label class="form-check-label" for="sexoMujer">Mujer</label>
                                </div>
                            </div>
                        </div>
                         <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="codigoDoctor" required placeholder="codigo del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="tituloDoctor" required placeholder="Título del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="direccion" placeholder="Dirección ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="cel" placeholder="Télefono del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="date" class="form-control" name="nacimiento" placeholder="fecha de nacimiento">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="form-group">
                                <a href="{{route('doctores.index')}}" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary" type="submit" >Guardar</button>
                        </div>
                    </div>


        </div>
     </div>
        </div>
    </form>



@endsection
