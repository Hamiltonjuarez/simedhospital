@extends('theme.lte.layout')
@section('styles')
    <style>
        .bwidth{
            width: 250px;
            height: 100px;
        }
    </style>
@endsection
@section('contenido')
<div class="card ">
    <div class="card-body d-flex justify-content-center">
    <h3>{{$area->habitacion_nombre}}</h3>
    
    </div>
</div>
<div class="card" id="botonera">
    <div class="card-header">
        <div class="row">
            <div class="col">
                @if ($encargadodato == 1)
                     <h4>Encargado: {{$encargado->nombre}}</h4>
                @else
                    <div class="row">
                    <form action="{{route('estacion.selectencargado')}}" method="POST">
                            @csrf
                            <div class="col">
                                <div class="form-group">
                                 <label for="">Seleccione Encargado de habitacion</label>
                                 <select name="encargado" class="form-control" id="personalselect">
                                     <option value="">seleccione un encargado</option>
                                     @foreach ($flota as $persona)
                                          <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                                     @endforeach
                                 </select>
                                <input type="hidden" name="habitacion" value="{{$habitacionpaciente->id}}">
                                </div>
                             </div>
                             <div class="col" style="position:absolute; top:0.8cm;left:7.3cm">
                                <button type="submit" class="btn btn-primary"> seleccionar encargado</button>
                             </div>
                        </form>
                    </div>
                @endif
            </div>
            <div class="col d-flex justify-content-center">
                @if ($paciente == null)
                   <h4> !Paciente no Asignado </h4>             
                @else
                  <h4 style="position:absolute;">Paciente: {{$paciente->nombre.' '.$paciente->apellidos}}</h4>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
      @if ($area->estado == 'en limpieza')
          <div class="row">
              <div class="col">
                <div class="alert alert-primary d-flex justify-content-center" role="alert">
                   <h4>La habitacion se esta limpiando</h4>
                  </div>
              </div>
          </div>
          <div class="row">             
              <div class="col d-flex justify-content-center">
                <button class='btn btn-lg btn-success' {{-- style='background-color:#007bff;' --}}> 
                    <div style='text-align:center;'><i onclick="habitacionlibre()" class="btn fa fa-bed" style="font-size:90px;color:white;"><i class="fa fa-check"></i></i></div>  
                      <h4 style="color:white">Habitacion disponible</h4>
                  </button>
                <form action="{{route('estacion.habitaciondisponible')}}" method="POST" id="formdisponible">
                      @csrf
                  <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion">
                  </form>
              </div>
          </div>
      @else
      <div class="row">
        <div class="col d-flex justify-content-center">
             @if ($encargadodato == 1 )
             <button class='btn btn-lg' style='background-color:#007bff;'> 
                 <div style='text-align:center;'><i onclick="changeencargado()" class="btn fa fa-user-md" style="font-size:90px;color:white;"></i></div>  
                   <h4 style="color:white">Cambiar asignado</h4>
               </button>
                 
             @endif
        </div>         
       
             @if ($paciente != null)
             <div class="col d-flex justify-content-center">
                 @if ($paciente->estado_traslado == 'enviado')
                   <button class='btn btn-lg' onclick="pacientearrive()" style='background-color:#17a2b8;'> 
                     <div style='text-align:center;'><i class="btn fa fa-check" style="font-size:90px;color:white;"></i></div>  
                        <h4 style="color:white"> Paciente en habitacion</h4>
                   </button>
                 @else
                     @if ($paciente->estado_traslado == 'en habitacion')
                         <button class='btn btn-lg' onclick="perfil({{$paciente->id}})" style='background-color:#17a2b8;'> 
                             <div style='text-align:center;'><i class="btn fa fa-user" style="font-size:90px;color:white;"></i></div>  
                             <h4 style="color:white"> Perfil del paciente</h4>
                         </button>
                     @endif
                 @endif
            
                 
            </div>
             @endif
       
        @if ($paciente != null)
        
            <div class="col d-flex justify-content-center">
                <button class='btn btn-lg btn-warning' onclick="liberarhabitacion()"> 
                    <div style='text-align:center;'><i class="btn fa fa-sign-out" style="font-size:90px;color:white;"></i></div>  
                    <h4 style="color:white">Liberar Habitacion</h4>
                </button>
               <form action="{{route('estacion.freeroom')}}" method="POST" id="formfreeroom" >
                    @csrf
                <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion">
                </form>
            </div>
        @endif
      
    </div>
      @endif
    </div>
</div>
<div class="card " id="cambioencargado" style="width:20cm; margin:auto; display:none">
    <div class="card-header d-flex justify-content-center">
        <h4>Seleccione nuevo encargado</h4>
    </div>
    <div class="card-body">
    <form action="{{route('estacion.cambiarencargado')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Seleccione Encargado de habitacion</label>
                <select name="encargado" class="form-control" id="personalselect">
                    <option value="">seleccione un encargado</option>
                    @foreach ($flota as $persona)
                         <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                    @endforeach
                </select>
               <input type="hidden" name="habitacion" value="{{$habitacionpaciente->id}}">
               <hr>
            </div>
            <div class="form-group d-flex justify-content-center">
                
                <button type="button" onclick="cancelchange()" class="btn btn-secondary mr-1">Cancelar</button>
                <button type="submit" class="btn btn-primary">Cambiar encargado</button>
               
            </div>
        </form>
    </div>
</div>
@if ($paciente != null)
<form action="{{route('anexos.altahabitacion')}}" method="POST" id="formalta">
    @csrf
    <input type="hidden" value="{{$paciente->id}}" name="paciente">
    <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion">
</form>
<form action="{{ route('estacion.pacientesala') }}" id="pacientellego" method="POST">
    @csrf
    <input type="hidden" value="{{$paciente->id}}" name="id">
    <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion_id">
</form>
@endif
@endsection
@section('scripts')
    <script>
         function pacientearrive(){
            $('#pacientellego').submit();
        }
        function perfil(id){
            window.location="{{route('pacientes.index')}}"+'/'+id;
        }
        function habitacionlibre(){
            $('#formdisponible').submit();
        }
        function liberarhabitacion(){
            $('#formfreeroom').submit();
        }
        function changeencargado(){
            document.getElementById('cambioencargado').style.display = 'block';
            document.getElementById('botonera').style.display = 'none';
        }
        function cancelchange(){
            document.getElementById('cambioencargado').style.display = 'block';
            document.getElementById('botonera').style.display = 'none';
        }
        /* function hojaalta(paciente){
           $('#formalta').submit();
        } */
    </script>
@endsection