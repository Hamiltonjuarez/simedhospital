@extends('theme.lte.layout')
@section('styles')
    <style>
        table th{
            text-align: center;
        }

        .align-bottom{
            vertical-align: bottom
        }
        .button{
            position: relative;
        }
        .table{
            margin-top: 5px;
        }
        
    </style>
@endsection
@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-tittle">{{ $area->nombre_area }}</h4>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-4">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="tipoExamen">Tipo de Examen: </label>
                                    <select name="tipoExamen" id="tipoExamen" class="form-control">
                                        @foreach ($examenes as $examen)
                                            <option value="{{ $examen->id }}">{{ $examen->procedimiento_nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn button btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered table-primary" id="campos">
                        <tr>
                            <th>Descripcion</th>
                            <th width="150">Unidad</th>
                            <th width="150">Resultado</th>
                            <th>Rango</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="descripcion[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="unidad[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resultado[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="rango[]" class="form-control">
                            </td>
                        </tr>
                    </table>
                    <p>

                        <button class="btn btn-primary" id="agregar" onclick="agregar()">+ Agregar nueva descripcion</button>
                    <div class="row align-bottom">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="observaciones">Observaciones:</label>
                                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function agregar(){
            $('#campos').append('<tr><td><input type="text" name="descripcion[]" class="form-control"></td>'
                            + '<td><input type="text" name="unidad[]" class="form-control"></td>'
                            + '<td><input type="text" name="resultado[]" class="form-control">'
                            + '</td><td><input type="text" name="rango[]" class="form-control"></td></tr>');
        }

    </script>
@endsection