@extends('theme.lte.layout')

@section('contenido')
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow shadow-lg border border-primary">
          <div class="card-header bg-primary">
            Procedimientos/Consultas
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-hover" id="procedimientos">
                <thead class="bg-info">
                  <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
    <script>
      $(document).ready(function(){
        $("#procedimientos").DataTable({
          "processing" : true,
          "serverSide" : true,
          "ajax" : "{{route('procedimiento.listprocedimientos')}}",
          "columns": [
            { "data": "nombre"},
            { "data": "apellidos"},
            { "data": "created_at"},
            { "data": "tipo"}
          ]
        })
      })
    </script>
@endsection