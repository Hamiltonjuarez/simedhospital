@extends('theme.lte.layout')
@section('styles')
<style>
    .form-control{
       border: 1px solid #ced4da;
    }
</style>
@endsection
@section('contenido')
<form action="{{route('consultas.store')}}" method="POST" class="form-horizontal">
    @csrf
    <div class="container" id="newConsulta">
        <div class="row justify-content-center">
            <div class=" col-md-12 ">
                    <div class="card mt-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6 d-none d-md-block form-group ">
                                            <a href="{{route('pacientes.index')}}" class="btn btn-sm btn-info"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Lista de pacientes</a>
                                            <a href="{{route('pacientes.show',$paciente->id)}}" class="btn btn-sm btn-info"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Perfil paciente</a>
                                    </div>
                                    <div class="col-md-6  text-right">
                                        <h4 >NUEVA CONSULTA MEDICA</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="paciente_id" id="paciente_id" value="{{$paciente->id}}">
                                <div class="row form-group">
                                    <div class="col-md-8 col-sm-12">
                                        <label for="detalleConsulta">Motivo de la consulta médica:</label>
                                        <input type="text" class="form-control @error('motivo') is-invalid @enderror" name="tituloConsulta" id="tituloConsulta" value="{{ old('tituloConsulta') }}" required autocomplete="tituloConsulta" autofocus  >
                                        @error('motivo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="precioConsulta">Precio de la consulta médica:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control precio" name="precioConsulta" value="25.50">
                                        </div>
                                    </div>
                                </div>
                                <div class="card text-center ">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#parte1" v-on:click="addDetalle">Detalle</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#parte2" v-on:click="addDiag">Diagnóstico</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#parte3" v-on:click="addPres">Prescripción</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-pane active" id="parte1">
                                            <div class="form-group" v-show="mostrarDetalle">
                                                <textarea id="detalle" class="form-control textarea detalleConsulta" id="detalleConsulta" name="detalleConsulta" cols="30" rows="6.5" required  placeholder="Detalle de consulta"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane " id="parte2">
                                            <div class="form-group" v-show="mostrarDiag">
                                                <diagnostico ></diagnostico>
                                            </div>
                                        </div>
                                        <div class="tab-pane " id="parte3">
                                            <div class="form-group" v-show="mostrar">
                                                <prescripcion ></prescripcion>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="form-group text-center">
                                        <a href="{{route('pacientes.show', $paciente->id  )}}" class="btn  btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn  btn-primary" name="receta">Añadir Receta</button>
                                        <button type="submit" class="btn  btn-primary " name="guardar"> Guardar</button>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')

<script>
    $(function () {
        $('.textarea').wysihtml5({
            toolbar: { fa: true,
                "image" : false,
                "link" : false,
                "font-styles" : false,
            },
            useLineBreaks : true,
        })
    });

    </script>
@endsection
