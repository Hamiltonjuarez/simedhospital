@extends('theme.lte.layout')
@section('contenido')
    <form action="{{route('consultas.update', $consulta->id)}}" method="POST" id="formConsulta" {{-- target="_blank" --}}>
        @csrf
        <div class="container" id="newConsulta">
            <div class="row justify-content-center" >
                <div class="col-md-12">
                    <div class="card border-success mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8 d-none d-md-block">
                                    <a href="{{route('pacientes.show', $consulta->paciente)}}" class="btn btn-sm btn-info"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Perfil del paciente</a>
                                </div>
                                <div class="col-md-4 col-sm-12 text-md-right ">
                                    <h3>Editar consulta</h3>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="row form-group">
                                <div class="col-md-9 col-sm-9">
                                    <label for="tituloConsulta">Motivo de la consulta médica:</label>
                                    <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="paciente" value="{{$consulta->paciente}}">
                                            <input type="text" class="form-control" name="tituloConsulta" id="tituloConsulta" value="{{$consulta->tituloConsulta}}">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                        <label for="precio" >Precio : </label>
                                        <input type="text" class="form-control" name="precioConsulta" value="{{$consulta->precioConsulta}}">
                                </div>
                            </div>
                            
                            <div class="card text-center ">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#parte1" v-on:click="addDetalle"> Detalle</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#parte2" v-on:click="addDiag"> Diagnóstico</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#parte3" v-on:click="addPres">Prescripción</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                            <div class="tab-pane active" id="parte1">
                                                <div class="form-group" v-show="mostrarDetalle">
                                                        <textarea name="detalleConsulta" class="textarea form-control" id="detallequery" cols="40" rows="10">{!!$consulta->detalleConsulta!!}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane active" id="parte2">
                                                    <div class="form-group" v-show="mostrarDiag">
                                                            <textarea name="diagnostico" class="textarea form-control"  cols="30" rows="10">{!!$consulta->diagnostico!!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="tab-pane active" id="parte3">
                                                        <div class="form-group" v-show="mostrar">
                                                                <textarea name="prescripcion" class="textarea form-control"  cols="30" rows="10">{!!$consulta->prescripcion!!}</textarea>
                                                        </div>
                                                    </div>
                                    </div>       
                            </div>
                           
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary pull-right ml-1">Actualizar</button>
                           

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
