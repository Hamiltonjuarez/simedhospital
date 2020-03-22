@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 div col-sm-12">
                <form action="{{route('clinicas.update', $clinica->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h5 class="text-uppercase" style="font-family:sans-serif">editar clinica {{$clinica->nombreClinica}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="clinicaName">Nombre:</label>
                                        <input type="text" name="nombreClinica" id="clinicaName" class="form-control" required value="{{$clinica->nombreClinica}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaSlogan">Slogan:</label>
                                        <input type="text" name="slogan" id="clinicaSlogan" class="form-control" value="{{$clinica->slogan}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaDireccion">Dirección:</label>
                                        <input type="text" name="direccion" id="clinicaDireccion" class="form-control" required value="{{$clinica->direccion}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaTelefonos">Teléfonos:</label>
                                        <input type="text" name="telefonos" id="clinicaTelefonos" class="form-control" required value="{{$clinica->telefonos}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaCelular">Celular:</label>
                                        <input type="text" name="celular" id="clinicaCelular" class="form-control" value="{{$clinica->celular}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="clinicaFacebook">Facebook:</label>
                                        <input type="text" name="facebook" id="clinicaFacebook" class="form-control" value="{{$clinica->facebook}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaInstagram">Instagram</label>
                                        <input type="text" name="instagram" id="clinicaInstagram" class="form-control" value="{{$clinica->instagram}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaWeb">Página web:</label>
                                        <input type="text" name="paginaWeb" id="clinicaWeb" class="form-control" value="{{$clinica->paginaWeb}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaEmail">Email:</label>
                                        <input type="text" name="email" id="clinicaEmail" class="form-control" value="{{$clinica->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{route('clinicas.index')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
