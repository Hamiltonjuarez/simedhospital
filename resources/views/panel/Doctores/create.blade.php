@extends('theme.lte.layout')
@section('contenido')

<form  action="{{ route('doctores.store') }}" method="POST" >
        @csrf

        <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <div class="card shadow-lg p-3 mb-5">



                    <div class="card-header">
                        <h4 class="text-uppercase" style="font-family:sans-serif">Crear Doctor</h4>

                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <select class="custom-select" name="user_id">
                                        <option selected >Añadir Usuario </option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                        </select>
                                        <div class="input-group-append">
                                        <label class="input-group-text" for="inputGroupSelect02">Usuarios</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="nombreDoctor" placeholder="Nombre del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="apellidosDoctor" placeholder="Apellidos del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="sexo" placeholder="Sexo">
                            </div>
                        </div>
                         <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="codigoDoctor" placeholder="codigo del doctor">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="tituloDoctor" placeholder="Título del doctor">
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
                        <div class="row form-group">
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file" required onchange="showPreview()">
                                    <label class="custom-file-label" id="labelName" name="file" for="customFile" >Seleccionar Archivo</label>
                                </div>
                                <img src="" width="200" height="200" alt="" id="prueba" class="img-thumbnail"/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="form-group">
                                <a href="{{route('doctores.index')}}" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary" type="submit" onclick="compressAndUpload(this.form.file.value)">Guardar</button>
                        </div>
                    </div>


        </div>
     </div>
        </div>
    </form>



@endsection
