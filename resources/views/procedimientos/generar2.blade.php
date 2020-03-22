@extends('theme.lte.layout')
@section('styles')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">
@endsection
@section('contenido')
    <div class="row justify-content-md-center">
        <div class="col-md-12 mt-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Generar Reporte</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="{{route('reportes.store')}}" >
                            @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                                <input type="hidden" name="model" value="{{ $model }}">
                                <label>Nombre: </label> {{ $paciente->nombre }} <br>
                                <label>Edad: </label> {{$paciente->edad}} <br>
                                <label>Genero: </label> {{$paciente->sexo}} <br>
                            </div>
                            <div class="col-sm-6">
                                <label>codigo: </label> {{$paciente->codigo}} <br>
                                <div class="form-inline">
                                    <select name="tipoexamen_id" class="form-control">
                                        <option value="1">Endoscopía</option>
                                        <option value="1">Colonoscopía</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <textarea name="hallazgos" class="textarea" placeholder="Hallazgos Endoscopícos..."
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <textarea name="diagnostico" class="textarea" placeholder="Diagnóstico Endoscopíco..."
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                        </div>

                            
                            {{-- <div class="mb-3">
                                <textarea name="observaciones" class="textarea" placeholder="Observaciones..."
                                    style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div> --}}
                    </div>
                    <!-- /.card-body -->



                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar reporte</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->


        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
    <script>
    $(function () {
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5({
            toolbar: { fa: true, 
                "image" : false,
                "link" : false,
                "font-styles" : false
            },
        })
    })
    </script>
@endsection
