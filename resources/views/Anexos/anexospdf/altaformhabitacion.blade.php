@extends('theme.lte.layout')
@section('styles')
<link rel="stylesheet" href="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.css")}}">
    <style>
      .labels{
        cursor: pointer;
      }
    </style>
@endsection
@section('contenido')
    @if($tipo == 'alta')@include('Anexos.altaform')@endif
    @if($tipo == 'incapacidad')@include('Anexos.incapacidaform')@endif
@endsection
@section('scripts')
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.js")}}"></script>
    <script>


    function enviarincapacidad(){
      if($("#diagnosticoinca").val().length>0)
      {
        if($("#hasta").val() > $("#desde").val()){
          document.getElementById('formincapacidad').submit();
          window.location = "{{route('pacientes.show', $paciente->id)}}";
        }else{
          $("#errorhasta").show();
          $("#hasta").addClass("is-invalid");
          $("#hasta").focus();
          $("#mensaje").html("La fecha debe ser mayor a "+ $("#desde").val())
        }
      }else{
        $("#errorsito").show();
        $("#diagnosticoinca").addClass("is-invalid");
        $("#diagnosticoinca").focus();
        $("#diagnosticoinca").prop('required',true);
      }
      
    }

    $('.calendar').datetimepicker({
        format: 'DD-MM-YYYY',
        date: moment().format(),
    });

    $('#sihospi').click(function(){
      document.getElementById('hospi-hidden').style.display = "block";
    });
    $('#nohospi').click(function(){
      document.getElementById('hospi-hidden').style.display = "none";
    });

    function enviaralta(){
        if($("#diagnosticoalta").val().length>0)
        {
          document.getElementById("formcreatealta").submit();
         
        }else{
          $("#diagnosticoalta").addClass("is-invalid");
          $("#diagnosticoalta").focus();
          toastr.error('Por favor detalle el diagnóstico');
        }
    }

   
      
    </script>
@endsection