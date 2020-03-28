@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
<div class="card  cborder2" style="height:8cm">
    <form action="{{-- {{route('pacientes.listadocitasarea')}} --}}" method="POST" id="redirectionform">
    {{-- <input type="hidden" value="{{$paciente->id}}" name="paciente" id="paciented"> --}}
        @csrf
        <div class="card-header d-flex justify-content-center">
            <h3>Crear Cita </h3>
        </div>
        <div class="card-body">
        <div class="row form-group">
            <div class="col-md-6">
                <label for="">Seleccione area de ingreso:</label>
                <select  name="areas" id="areas2" class="form-control selectpicker" data-live-search="true" onchange="seleccionarArea2()">                          
                    <option value="" selected disabled>Seleccione Area</option>                  
                    @foreach ($areas as $area)
                <option value="{{$area->id}}" id="{{$area->nombre_area}}" >{{$area->nombre_area}}</option>                        
                    @endforeach                    
                </select> 
            </div>
            <div id="divhabitaciones2" class="col" style="display:none">
                <label id="labelmedicamento2" for=""></label>
                <select  name="habitaciones" id="habitaciones2" class="form-control" onchange="cargaprocedures()" >                          
                    <option value="rrr" selected >Seleccione </option>                                                         
                </select>
            </div>
        </div>
            <div class="row d-flex justify-content-center displaybtn" >
            <div class="col-md-6">
                <div id="divprocedimientos" style="display:none">
                    <label id="prolabel"   for="">Seleccione procedimiento</label>
                <select  name="procedimiento" id="procedimiento"   class="form-control " data-live-search="true" onchange="submitalready()">                          
                    <option value="0" selected disabled selected>procedimientos disponibles</option>                                                         
                </select>
                  </div> 
           </div>
            <div class="col">
                <button type="button" id="btngo2" style="display:none;  position:absolute;top:0.8cm;left:3.5cm" class="btn btn-primary" onclick="enviarcita()">Ver Agenda</button>
            </div>
           
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script>
          var conta = 0;
          function seleccionarArea2(){
        document.getElementById('divhabitaciones2').style.display = "block";
        
       var dato = $('#areas2').val();
       if(dato == 7){
           document.getElementById('procedimiento').style.display = 'block';
       }
       if(conta == 0){           
          $('#pasodatos2').val(dato);
       }
       var compa = $('#pasodatos2').val(); 
      if(dato == compa){
        $.ajax({
                url: '{{ route("pacientes.habitaciones2") }}',
                type: 'GET',
                data:{'dato':dato, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {      var contador = 0;        
                console.log(response[0]);
                  response[0].forEach(element => {
                    var select = document.getElementById('habitaciones2');
                    var option = document.createElement('option');
                    option.innerHTML= response[0][contador].habitacion_nombre;
                    option.value = response[0][contador].id;
                    select.appendChild(option);
                    contador++;                    
                  });
                  var labb = document.getElementById('labelmedicamento2');
                  var are = document.getElementById('areas2');
                  var tex = are.options[are.selectedIndex].id;
                  labb.innerHTML = "Seleccione: "+ tex;
                  $("#habitaciones2").prop("selectedIndex", 0).text(tex='disponibles');
                    
                                  
                 $('#cantidad').val(response[0].length)
                
                /*  console.log(response[0][0].habitacion_nombre); */
            }
        });     
      }else{          
          $('#pasodatos2').val(dato);
          var objett = document.getElementById('habitaciones2');
          $('#habitaciones2 option:not(:first)').remove();

          $.ajax({
                url: '{{ route("pacientes.habitaciones2") }}',
                type: 'GET',
                data:{'dato':dato, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {      var contador = 0;        
                console.log(response[0]);
                  response[0].forEach(element => {
                    var select = document.getElementById('habitaciones2');
                    var option = document.createElement('option');
                    option.innerHTML= response[0][contador].habitacion_nombre;
                    option.value = response[0][contador].id;
                    select.appendChild(option);
                    contador++;                    
                  });
                  var labb = document.getElementById('labelmedicamento2');
                  var are = document.getElementById('areas2');
                  var tex = are.options[are.selectedIndex].id;
                  labb.innerHTML = "Seleccione: "+ tex;
                 $('#cantidad').val(response[0].length)
                
                /*  console.log(response[0][0].habitacion_nombre); */
            }
        });   
      }
      conta++;
    }
    function enviarcita(){
        var habitacion = $('#habitaciones2').val();
        var select = document.getElementById('procedimiento');
        var procedure = select.value;
        
       
        window.location="{{route('prueba')}}"+'/'+habitacion+'/'+procedure;
    }
    function submitalready(){
        var procedure = document.getElementById('procedimiento').value;
        if (procedure != null){
            document.getElementById('btngo2').style.display = "block";
        }
    }
    function cargaprocedures(){
        var area = $('#areas2').val();
      
        dato = area;
       
        if(area == 5 || area == 6 || area == 7){        
              
            document.getElementById('divprocedimientos').style.display = 'block';
            $('#procedimiento option:not(:first)').remove();           
                $.ajax({
                    url: '{{ route("pacientes.procedimientos_areas") }}',
                    type: 'GET',
                    data:{'dato':dato, '_token': '{{ csrf_token() }}'},
                success:function(response)
                {      var contador = 0;    
                         
                    response[0].forEach(element => {
                        var select = document.getElementById('procedimiento');
                        var option = document.createElement('option');
                        option.innerHTML= response[0][contador].procedimiento_nombre;
                        option.value = response[0][contador].id;
                        select.appendChild(option);
                        contador++;                    
                    });
               
                }
               
            });   

        }
        else{            
            document.getElementById('divprocedimientos').style.display = 'none';
            document.getElementById('btngo2').classList.addClass = 'centerbtn';
            document.getElementById('btngo2').style.display = "block";
        }
    }
    </script>
@endsection