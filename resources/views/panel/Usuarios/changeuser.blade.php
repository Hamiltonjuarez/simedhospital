@extends('theme.lte.layout')
@section('styles')
    <style>
        .ocultar{
            display: none;
        }
    </style>
@endsection
@section('contenido')
<div class="container">
    <div class="card shadow shadow-lg card-primary border border-primary">
        <div class="card-header">
            <h3 class="card-title">Lista de usuarios</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-sm" style="width:100%" id="users">
                    <thead >
                        <tr class="table-primary">
                            <td class="ocultar"></td>
                            <td>NAME</td>
                            <td>USUARIO</td>
                            <td>TIPO</td>
                            <td>CORREO</td>
                            <td>FECHA</td>
                            <td >CAMBIAR</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $("#users").DataTable({
        language: {
               "decimal": "",
               "emptyTable": "No hay información",
               "info": "Mostrando _START_ a _END_ de _TOTAL_ Pacientes",
               "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
               "infoFiltered": "(Filtrado de _MAX_ total Pacientes)",
               "infoPostFix": "",
               "thousands": ",",
               "lengthMenu": "Mostrar _MENU_ Pacientes",
               "loadingRecords": "Cargando...",
               "processing": "Procesando...",
               "search": "Buscar:",
               "zeroRecords": "Sin resultados encontrados",
               "paginate": {
                   "first": "Primero",
                   "last": "Ultimo",
                   "next": "Siguiente",
                   "previous": "Anterior"
               }
           },
           "processing": true,
           "serverSide": true,
           "ajax": "{{route('users.list')}}",
           "columns": [
                { "data": "id", "orderable": false, className: "ocultar"},
                { "data": "name"},
                { "data": "username"},
                { "data": "display_name", "searchable": false},
                { "data": "email",  "orderable": false},
                { "data": "created_at"},
                { "data": "btn", "orderable": false, "searchable": false}
            ],
    });

</script>
@endsection