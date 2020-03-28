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
    <div class="card">
    <h2 class="text-center"> {{$habitacionpaciente->habitacion_nombre}}</h2>
    </div>
    @if ($habitacionpaciente->estado == 'en limpieza')
        <div class="card">
            <div class="card-header">
                <h3>Habitacion en limpieza</h3>
            </div>
            <div class="card-body">
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
            </div>
        </div>
        
   @else
    <div class="card">
        <div class="card-header">
            
            @if($paciente == 'noasignado' )
           <p>No Hay paciente en espera </p>
            @else 
            @if ($operacion != 'no asignado')
            <div class="row">
                <div class="col text-center">
                    <h3>Operacion de: {{$operacionnombre->procedimiento_nombre}}</h3>
                </div>
                <div class="col text-center">
                <h3>Paciente: {{$paciente->nombre." ".$paciente->apellidos}}</h3>
                </div>
            </div>
            @else 
            <div class="row">                
                <div class="col">
                <h3>Paciente: {{$paciente->nombre." ".$paciente->apellidos}}</h3>
                </div>
            </div>
            @endif
       
           

        </div>
        <div class="card-body">
            @if ($operacion_id != 0)
               <div id="botones" style="display:block">
                   <div class="row">
                       <div class="col text-center">
                        <button class='btn btn-lg' style='background-color:#007bff;'> 
                            <div style='text-align:center;'><i onclick="info()" class="btn fa fa-user-md" style="font-size:90px;color:white;"></i></div>  
                              <h4 style="color:white">Personal asignado</h4>
                          </button>
                       </div>
                       <div class="col text-center">
                           @if ($paciente->estado_traslado != 'en habitacion')
                           <button class='btn btn-lg' onclick="pacientearrive()" style='background-color:#17a2b8;'> 
                            <div style='text-align:center;'><i class="btn fa fa-check" style="font-size:90px;color:white;"></i></div>  
                               <h4 style="color:white"> Paciente en habitacion</h4>
                          </button>
                            @else
                            <button class='btn btn-lg' onclick="perfil({{$paciente->id}})" style='background-color:#17a2b8;'> 
                                 <div style='text-align:center;'><i class="btn fa fa-user" style="font-size:90px;color:white;"></i></div>  
                                <h4 style="color:white"> Perfil del paciente</h4>
                            </button>
                           @endif
                          <form action="{{ route('estacion.pacientesala') }}" id="pacientellego" method="POST">
                              @csrf
                          <input type="hidden" value="{{$paciente->id}}" name="id">
                          <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion_id">
                         </form>
                    </div>
                     <div class="col text-center">
                        <button class='btn btn-lg'onclick="beginop()" style='background-color: #28a745;'> 
                            <div style='text-align:center;'><i class="btn fa fa-play" style="font-size:90px;color:white;"></i></div>  
                            <h4 style="color:white"> Empezar operacion</h4>
                          </button>
                        <form action="{{route('estacion.startop')}}"  method="POST" id="beginoperation">
                                @csrf
                            <input type="hidden" value="{{$paciente->id}}" name="pacienteid">
                            <input type="hidden" value="{{$operacion_id}}" name="operacionid">
                            <input type="hidden" value="{{$operacionnombre->id}}" name="opname">
                          </form>
                     </div>
                   </div>
                </div> 
                 <div id="formulariopersonal2" style="display:none">
                <h4 class="text-center">Datos del personal medico </h4>       
                <form action="{{route('estacion.Personaloperacion')}}" method="POST">
                    <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion_id">
                    <input type="hidden" id="operacion_id" name="operacion_id" value="{{$operacion_id}}">
                    <input type="hidden" value="{{$paciente->id}}" name="paciente_id">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Doctor: </label>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="ckdoctor" onclick="ckfdoctor()">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Agregar doctor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <select name="doctorselect" class="form-control" id="doctorselect">
                                    <option value="">seleccione doctor</option>
                                    @foreach ($medicos as $medico)
                                <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                    @endforeach
                                </select>
                                <input style="display:none" type="text" id="doctorinput" name="doctorinput" class="form-control">
                                </div>
                                <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Anestesiólogo: </label>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="ckanestesiologo" onclick="ckfanestesiologo()">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Agregar doctor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <select name="anestesiologoselect" class="form-control" id="anestesiologoselect">
                                    <option value="">seleccione doctor</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                    @endforeach
                                </select>
                                <input style="display:none" name="anestesiologoinput" id="anestesiologoinput" type="text" class="form-control">
                                </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Primer ayudante: </label>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="ckprimer" onclick="ckfprimer()">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Agregar doctor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <select name="primerselect" class="form-control" id="primerselect">
                                    <option value="">seleccione doctor</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                    @endforeach
                                </select>
                                <input style="display:none" type="text" id="primerinput" name="primerinput" class="form-control">
                                </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                    <label for="">Segundo ayudante: </label>
                                    </div>
                                    <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="cksegundo" onclick="ckfsegundo()">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Agregar doctor
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <select name="segundoselect" class="form-control" id="segundoselect">
                                    <option value="">seleccione doctor</option>
                                    @foreach ($medicos as $medico)
                                    <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                    @endforeach
                                </select>
                                <input style="display:none" type="text" name="segundoinput" id="segundoinput" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Instrumentalista: </label>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="ckinstrumentalista" onclick="ckfinstrumentalista()">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Agregar doctor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <select name="instrumentalistaselect" class="form-control" id="instrumentalistaselect">
                                    <option value="">seleccione doctor</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                    @endforeach
                                </select>
                                <input style="display:none" type="text" id="instrumentalistainput" name="instrumentalistainput" class="form-control">
                                </div>
                                <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Circular: </label>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="ckcircular" onclick="ckfcircular()">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Agregar doctor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <select name="circularselect" class="form-control" id="circularselect">
                                    <option value="">seleccione doctor</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                    @endforeach
                                </select>
                                <input style="display:none" name="circularinput" id="circularinput" type="text" class="form-control">
                                </div>
                        </div>
                        <div class="row d-flex justify-content-center" style="padding: 50px;" >   
                                 
                            <button class="btn btn-primary" type="submit" >Cambiar datos </button>
                            <button id="btnback" style="display:none" class="btn btn-secondary" type="button" onclick="back()">Regresar</button>
                        </div>
                    </form>
                 </div>
            @else
            <div class="bottones" style="display:none">
               
            </div> 
            <div class="formulariopersonal" style="display:block">
           <h4 class="text-center">Datos del personal medico </h4>       
           <form action="{{route('estacion.Personaloperacion')}}" method="POST">
               <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion_id">
               <input type="hidden" id="operacion_id" name="operacion_id" value="{{$operacion_id}}">
               <input type="hidden" value="{{$paciente->id}}" name="paciente_id">
                   @csrf
                   <div class="row">
                       <div class="col">
                           <div class="row">
                               <div class="col">
                                   <label for="">Doctor: </label>
                               </div>
                               <div class="col">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="ckdoctor" onclick="ckfdoctor()">
                                       <label class="form-check-label" for="defaultCheck1">
                                           Agregar doctor
                                       </label>
                                   </div>
                               </div>
                           </div>
                           <select name="doctorselect" class="form-control" id="doctorselect">
                               <option value="">seleccione doctor</option>
                               @foreach ($medicos as $medico)
                           <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                               @endforeach
                           </select>
                           <input style="display:none" type="text" id="doctorinput" name="doctorinput" class="form-control">
                           </div>
                           <div class="col">
                           <div class="row">
                               <div class="col">
                                   <label for="">Anestesiólogo: </label>
                               </div>
                               <div class="col">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="ckanestesiologo" onclick="ckfanestesiologo()">
                                       <label class="form-check-label" for="defaultCheck1">
                                           Agregar doctor
                                       </label>
                                   </div>
                               </div>
                           </div>
                           <select name="anestesiologoselect" class="form-control" id="anestesiologoselect">
                               <option value="">seleccione doctor</option>
                               @foreach ($medicos as $medico)
                                   <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                               @endforeach
                           </select>
                           <input style="display:none" name="anestesiologoinput" id="anestesiologoinput" type="text" class="form-control">
                           </div>
                   </div>
                   <div class="row">
                       <div class="col">
                           <div class="row">
                               <div class="col">
                                   <label for="">Primer ayudante: </label>
                               </div>
                               <div class="col">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="ckprimer" onclick="ckfprimer()">
                                       <label class="form-check-label" for="defaultCheck1">
                                           Agregar doctor
                                       </label>
                                   </div>
                               </div>
                           </div>
                           <select name="primerselect" class="form-control" id="primerselect">
                               <option value="">seleccione doctor</option>
                               @foreach ($medicos as $medico)
                                   <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                               @endforeach
                           </select>
                           <input style="display:none" type="text" id="primerinput" name="primerinput" class="form-control">
                           </div>
                       <div class="col">
                           <div class="row">
                               <div class="col">
                               <label for="">Segundo ayudante: </label>
                               </div>
                               <div class="col">
                               <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="cksegundo" onclick="ckfsegundo()">
                                   <label class="form-check-label" for="defaultCheck1">
                                       Agregar doctor
                                   </label>
                                   </div>
                               </div>
                           </div>
                           <select name="segundoselect" class="form-control" id="segundoselect">
                               <option value="">seleccione doctor</option>
                               @foreach ($medicos as $medico)
                               <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                               @endforeach
                           </select>
                           <input style="display:none" type="text" name="segundoinput" id="segundoinput" class="form-control">
                       </div>
                   </div>
                   <div class="row">
                       <div class="col">
                           <div class="row">
                               <div class="col">
                                   <label for="">Instrumentalista: </label>
                               </div>
                               <div class="col">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="ckinstrumentalista" onclick="ckfinstrumentalista()">
                                       <label class="form-check-label" for="defaultCheck1">
                                           Agregar doctor
                                       </label>
                                   </div>
                               </div>
                           </div>
                           <select name="instrumentalistaselect" class="form-control" id="instrumentalistaselect">
                               <option value="">seleccione doctor</option>
                               @foreach ($medicos as $medico)
                                   <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                               @endforeach
                           </select>
                           <input style="display:none" type="text" id="instrumentalistainput" name="instrumentalistainput" class="form-control">
                           </div>
                           <div class="col">
                           <div class="row">
                               <div class="col">
                                   <label for="">Circular: </label>
                               </div>
                               <div class="col">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="ckcircular" onclick="ckfcircular()">
                                       <label class="form-check-label" for="defaultCheck1">
                                           Agregar doctor
                                       </label>
                                   </div>
                               </div>
                           </div>
                           <select name="circularselect" class="form-control" id="circularselect">
                               <option value="">seleccione doctor</option>
                               @foreach ($medicos as $medico)
                                   <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                               @endforeach
                           </select>
                           <input style="display:none" name="circularinput" id="circularinput" type="text" class="form-control">
                           </div>
                   </div>
                   <div class="row d-flex justify-content-center" style="padding-top: 20px;" >                      
                       <button class="btn btn-primary" type="submit">Guardar datos  datos </button>                     
                   </div>
               </form>
            </div>  
            @endif
            @endif
        </div>
        <form action="{{route('estacion.habitaciondisponible')}}" method="POST" id="formdisponible">
            @csrf
        <input type="hidden" value="{{$habitacionpaciente->id}}" name="habitacion">
        </form>
        @include('estacion.mostrardatos')
       {{--  <div class="card-footer">
           
        </div> --}}
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        function habitacionlibre(){
            $('#formdisponible').submit();
        }
        function ckfdoctor(){
           var ckdoc = document.getElementById('ckdoctor');
           if(ckdoc.checked == true){
              document.getElementById('doctorinput').style.display = 'block';
              document.getElementById('doctorselect').style.display = 'none';
              $('#doctorselect').val('');

           }else{
              document.getElementById('doctorinput').style.display = 'none';
              document.getElementById('doctorselect').style.display = 'block';
              $('#doctorinput').val('');
           }
        }
        function ckfanestesiologo(){            
           var ckdoc = document.getElementById('ckanestesiologo');
           if(ckdoc.checked == true){
              document.getElementById('anestesiologoinput').style.display = 'block';
              document.getElementById('anestesiologoselect').style.display = 'none';
              $('#anestesiologoselect').val('');

           }else{
              document.getElementById('anestesiologoinput').style.display = 'none';
              document.getElementById('anestesiologoselect').style.display = 'block';
              $('#anestesiologoinput').val('');
           }
        }
        function ckfprimer(){
           var ckdoc = document.getElementById('ckprimer');
           if(ckdoc.checked == true){
              document.getElementById('primerinput').style.display = 'block';
              document.getElementById('primerselect').style.display = 'none';
              $('#primerselect').val('');

           }else{
              document.getElementById('primerinput').style.display = 'none';
              document.getElementById('primerselect').style.display = 'block';
              $('#primerinput').val('');
           }
        }
        function ckfsegundo(){
           var ckdoc = document.getElementById('cksegundo');
           if(ckdoc.checked == true){
              document.getElementById('segundoinput').style.display = 'block';
              document.getElementById('segundoselect').style.display = 'none';
              $('#segundoselect').val('');

           }else{
              document.getElementById('segundoinput').style.display = 'none';
              document.getElementById('segundoselect').style.display = 'block';
              $('#segundoinput').val('');
           }
        }
        function ckfinstrumentalista(){
           var ckdoc = document.getElementById('ckinstrumentalista');
           if(ckdoc.checked == true){
              document.getElementById('instrumentalistainput').style.display = 'block';
              document.getElementById('instrumentalistaselect').style.display = 'none';
              $('#instrumentalistaselect').val('');

           }else{
              document.getElementById('instrumentalistainput').style.display = 'none';
              document.getElementById('instrumentalistaselect').style.display = 'block';
              $('#instrumentalistainput').val('');
           }
        }
        function ckfcircular(){
           var ckdoc = document.getElementById('ckcircular');
           if(ckdoc.checked == true){
              document.getElementById('circularinput').style.display = 'block';
              document.getElementById('circularselect').style.display = 'none';
              $('#circularselect').val('');

           }else{
              document.getElementById('circularinput').style.display = 'none';
              document.getElementById('circularselect').style.display = 'block';
              $('#circularinput').val('');
           }
        }
        function info(){
            $('#mostrardatos').modal('show')  
           /*  document.getElementById('botones').style.display = 'none';
            document.getElementById('formulariopersonal').style.display = 'block'; */
        }
        function editarpersonal(){
            document.getElementById('botones').style.display = 'none';
            document.getElementById('formulariopersonal2').style.display = 'block';
            document.getElementById('btnback').style.display = 'block';
        }
        function back(){
            document.getElementById('botones').style.display = 'block';
            document.getElementById('formulariopersonal2').style.display = 'none';
        }
        function pacientearrive(){
            $('#pacientellego').submit();
        }
        function perfil(id){
            window.location="{{route('pacientes.index')}}"+'/'+id;
        }
        function beginop(){
            
            $('#beginoperation').submit();
        }
    </script>
@endsection