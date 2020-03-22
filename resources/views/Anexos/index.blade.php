@extends('theme.lte.layout')
@section('styles')
<link rel="stylesheet" href="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.css")}}">
    <style>
      .labels{
        cursor: pointer;
      }
      .hospitalizado{
        cursor: pointer;
      }
    </style>
@endsection
@section('contenido')
    <div class="container">
        <div class="card card-primary card-outline">
            <div class="card-header">
                ANEXOS
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-3">
                      <div class="nav flex-cÑOUolumn nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                          <a class="nav-link active text-center btn-block" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Formulario de incapacidad</a>
                        <a class="nav-link text-center btn-block" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Formulario de alta</a>
                      </div>
                    </div>
                    <div class="col-9">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">@include('Anexos.altaform')</div>
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">@include('Anexos.incapacidaform')</div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    @include('Anexos.nuevoPaciente')
@endsection
@section('scripts')
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.js")}}"></script>
    <script>
    
    
    function enviaralta(){
      if($("#pacientes").val() != "")
      {
        if($("#diagnosticoalta").val().length>0)
        {
          document.getElementById("formcreatealta").submit();
          var select = document.getElementById("pacientes");
          window.location = "{{route('pacientes.index')}}"+"/"+select.value;
        }else{
          $("#diagnosticoalta").addClass("is-invalid");
          $("#diagnosticoalta").focus();
          toastr.error('Por favor detalle el diagnóstico');
        }
      }else{
        $("#pacientes").focus();
        $("#pacientes").addClass("is-invalid");
        toastr.error('Por favor seleccione un paciente');
      }
    }

    function enviarincapacidad(){
      if($("#capacidad_id").val() != "")
      {
        if($("#diagnosticoinca").val().length>0)
        {
          if($("#hasta").val() > $("#desde").val()){
            document.getElementById('formincapacidad').submit();
            var select = document.getElementById("capacidad_id");
            window.location = "{{route('pacientes.index')}}"+"/"+select.value;
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
      }else{
          $("#capacidad_id").addClass("is-invalid");
          $("#capacidad_id").focus();
          toastr.error('Por favor seleccione un paciente');
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

    function mostrarModal(){
      $("#nuevoPacienteincapacidad").modal('show');
    }

    $("#cerrar").click(function(){
      document.getElementById("formnewpaciente").reset();
    });

    $("#siposee").click(function() {  
        document.getElementById('asegurados').style.display = "block";
    });

    $("#noposee").click(function() {  
        document.getElementById('asegurados').style.display = "none";
        document.getElementById('companiaseguro').value = "";
        document.getElementById('nopoliza').value = "";
        document.getElementById('nocarnet').value = "";
    });

    
      function createpacient(){
        var form = document.getElementById("formnewpaciente");
        var formdata = new FormData(form);
        var xhr =  new XMLHttpRequest();
        url = form.getAttribute("action");
        method = form.getAttribute('method');
        xhr.open(method,url,false);
        xhr.send(formdata);
        obj = JSON.parse(xhr.responseText);
          $("#nuevoPacienteincapacidad").modal('hide');
          form.reset();
          var o = new Option("option text", obj.id);
          $(o).html(obj.nombre);
          $("#capacidad_id").append(o);
          var select = document.getElementById("capacidad_id");
          for(var i=1;i<select.length;i++)
          {
              if(select.options[i].value==obj.id)
              {
                  select.selectedIndex=i;
              }
          }
      }
    </script>
@endsection