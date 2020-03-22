@extends('theme.lte.layout')
@section('contenido')
   <form action="{{route('clinicas.store')}}" method="POST">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card shadow-lg p-3 mb-5 rounded">
                    <div class="card-header">
                        <h5 class="text-uppercase" style="font-family:sans-serif">Nueva clinica</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="clinicaName">Nombre:</label>
                                    <input type="text" name="nombreClinica" id="clinicaName" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="clinicaSlogan">Slogan:</label>
                                    <input type="text" name="slogan" id="clinicaSlogan" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="clinicaDireccion">Dirección:</label>
                                    <input type="text" name="direccion" id="clinicaDireccion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="clinicaTelefonos">Teléfonos:</label>
                                    <input type="text" name="telefonos" id="clinicaTelefonos" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="clinicaCelular">Celular:</label>
                                    <input type="text" name="celular" id="clinicaCelular" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="clinicaFacebook">Facebook:</label>
                                    <input type="text" name="facebook" id="clinicaFacebook" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="clinicaInstagram">Instagram</label>
                                    <input type="text" name="instagram" id="clinicaInstagram" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="clinicaWeb">Página web:</label>
                                    <input type="text" name="paginaWeb" id="clinicaWeb" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="clinicaEmail">Email:</label>
                                    <input type="text" name="email" id="clinicaEmail" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer form-group text-center">
                        <a href="{{route('clinicas.index')}}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </form>
@endsection
