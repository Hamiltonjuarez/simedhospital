@extends('theme.lte.layout')
@section('styles')
    <style>
        .card{
            /* border: 3px solid rgb(93, 173, 226); */
            border: 3px solid rgb(113, 193, 236);
        }
        
        .card-header{
            /* border-bottom: 2px solid rgb(93, 173, 226); */
        }
        h5{
            background-color: rgb(204,229,255);
            color: rgb(0,64,135);
        }
        .card-title{
            /* color: rgb(36, 173, 176); */
            font-weight: bold;
            text-align: center;
            padding-bottom: 5px;
        }
        .alert>span{
            margin-right: 20px;
        }
        .editableclass{
            border: solid 1px #0069d9;
        }
    </style>
@endsection
@section('contenido')
    <div id="datos">
        <div class="row">
            <div class="col-sm-6">
                <div class="alert alert-primary">
                    <strong>Fecha: </strong> <span id="fecha"></span>
                    <strong> Hora: </strong> <span id="hora"></span> <i class="fa fa-clock-o"></i>
                </div>

            <h3>Quirofano : {{$habitacion->habitacion_nombre}}</h3>
                
            </div>
            <div class="col-sm-6 col-md-6 text-right">         
                 <button class="btn btn-primary"{{--  data-toggle="modal" data-target="#modaleditardatos" --}}onclick="edittrue()">Editar</button>
                <button class="btn btn-primary" onclick="endprocedure()">Finalizar</button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    
                    <div class="card-body">
                        <h5 class="card-title">DATOS DEL PACIENTE</h5>
                        <table class="table table-sm">
                            <tr>
                                <td width="100">
                                    Nombre:
                                </td>
                                <td>{{ $paciente->nombre.' '.$paciente->apellidos }} </td>
                            </tr>
                            <tr>
                                <td>
                                    Edad:
                                </td>
                                <td>{{ $paciente->getAgeAttribute() }} años</td>
                            </tr>
                            <tr>
                                <td>Sexo:</td>
                                <td>{{ $paciente->sexo }}</td>
                            </tr>
                            <tr>
                                <td>Notas:</td>
                                <td contenteditable="true">{{ $paciente->notas }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">DATOS DEL PERSONAL MEDICO</h5>
                        <table class="table table-sm ">
                            <tr>
                                <td >Cirujano:</td>
                            <td id="doctor">Dr.{{$doctor->nombre}}</td>
                            </tr>
                            <tr>
                                <td>
                                    Nombre del anestesiólogo:
                                </td>
                               
                                    <td id="anestesiologo">Dr.{{$anestesiologo->nombre}}</td>
                                
                            </tr>
                            <tr>
                                <td>
                                    Primer ayudante:
                                </td>
                               
                                    <td id="primer">Dr.{{$primer->nombre}}</td>
                              
                            </tr>
                            <tr>
                                <td>
                                    Segundo ayudante:
                                </td>
                               
                                    <td id="segundo">Dr.{{$segundo->nombre}}</td>
                               
                            </tr>
                            <tr>
                                <td>
                                    Instrumentista:
                                </td>
                                
                                    <td id="instrumentalista">Dr.{{$instrumentalista->nombre}}</td>
                              
                            </tr>
                            <tr>
                                <td>
                                    Circular
                                </td>
                               
                                    <td id="circular">Dr.{{$circular->nombre}}</td>
                              
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">DATOS DEL PROCEDIMIENTOS</h5>
                        <table class="table table-sm">
                            <tr>
                                <td width='235'>Cirujia:</td>
                            <td id="cirujia">{{$procedimiento->procedimiento_nombre}}</td>
                            </tr>
                            <tr>
                                <td>Tipo de anestesia:</td>
                                <td id="anestesia">General</td>
                            </tr>
                            <tr>
                                <td>Hora de inicio de anestesia:</td>
                                <td id="inicioanestesia">20:45</td>
                            </tr>
                            <tr>
                                <td>Hora de inicio de Cirugia:</td>
                                <td id="iniciocirujia">21:00</td>
                            </tr>
                            <tr>
                                <td>Tiempo transcurrido de cirugía:</td>
                                <td id="tiempo">00:34 (hrs:min)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CONTEO DE CAMPOS Y TORUNDAS</h5>
                        <table class="table table-sm">
                            <tr>
                                <TH width="200"></TH>
                                <th >TOTAL</th>
                            </tr>
                            <tr>
                                <th>COMPRESAS</th>
                                <TD id="compresas">0</TD>
                            </tr>
                            <tr>
                                <th>TORUNDAS</th>
                                <TD id="tornudas"></TD>
                            </tr>
                            <tr>
                                <th>GASAS</th>
                                <TD id="gasas"></TD>
                            </tr>
                            <tr>
                                <th>MECHAS V.</th>
                                <TD id="mechas"></TD>
                            </tr>
                            <tr>
                                <th>AGUJAS</th>
                                <TD id="agujas"></TD>
                            </tr>
                        </table>             
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('estacion.endoperation')}}" method="POST" id="endoperation">
                @csrf
            <input type="hidden" name="personal_id" value="{{$operacion->id}}">
            <input type="hidden" name="procedimiento_tipo" value="{{$procedimiento->id}}">
            <input type="hidden" name="compresas" id="compresassub">
            <input type="hidden" name="torundas" id="torundassub">
            <input type="hidden" name="gasas" id="gasassub">
            <input type="hidden" name="mechas" id="mechassub">
            <input type="hidden" name="agujas" id="agujassub">
            <input type="hidden" name="anestesia" id="anestesiasub">
            <input type="hidden" name="inicioanestesia" id="inicioanestesiasub">
            <input type="hidden" name="iniciocirujia" id="iniciocirujiasub">
            <input type="hidden" name="tiempo" id="tiemposub">
        </form>
    </div>
   
@endsection
@section('scripts')
    <script>
        function edittrue(){
           
            document.getElementById('cirujia').contentEditable = "true";
            document.getElementById('anestesia').contentEditable = "true";
            document.getElementById('inicioanestesia').contentEditable = "true";
            document.getElementById('iniciocirujia').contentEditable = "true";
            document.getElementById('tiempo').contentEditable = "true";
            document.getElementById('compresas').contentEditable = "true";
            document.getElementById('tornudas').contentEditable = "true";
            document.getElementById('gasas').contentEditable = "true";
            document.getElementById('mechas').contentEditable = "true";
            document.getElementById('agujas').contentEditable = "true";
            

                /* document.getElementById('doctor').classList.add('editableclass');
                document.getElementById('anestesiologo').classList.add('editableclass');
                document.getElementById('primer').classList.add('editableclass');
                document.getElementById('segundo').classList.add('editableclass');
                document.getElementById('instrumentalista').classList.add('editableclass');
                document.getElementById('circular').classList.add('editableclass'); */
            document.getElementById('cirujia').classList.add('editableclass');
            document.getElementById('anestesia').classList.add('editableclass');
            document.getElementById('inicioanestesia').classList.add('editableclass');
            document.getElementById('iniciocirujia').classList.add('editableclass');
            document.getElementById('tiempo').classList.add('editableclass');
            document.getElementById('compresas').classList.add('editableclass');
            document.getElementById('tornudas').classList.add('editableclass');
            document.getElementById('gasas').classList.add('editableclass');
            document.getElementById('mechas').classList.add('editableclass');
            document.getElementById('agujas').classList.add('editableclass');

            document.getElementById('editado').style.display = "block";
        }
        function update() {
            $('#fecha').html(moment().format('DD-MM-YYYY'));
            $('#hora').html(moment().format('H:mm:ss a'));
        }
        function endprocedure(){
         var cirujia =  document.getElementById('cirujia'); 
           var anestesia = document.getElementById('anestesia');
         var inicioanestesia = document.getElementById('inicioanestesia');
         var iniciocirujia = document.getElementById('iniciocirujia');
         var tiempocirujia =  document.getElementById('tiempo');
        var compresas =    document.getElementById('compresas');
        var tornudas =    document.getElementById('tornudas');
         var gasas =   document.getElementById('gasas');
         var mechas =    document.getElementById('mechas');
         var agujas =   document.getElementById('agujas');

         $('#anestesiasub').val(anestesia.innerHTML);
        $('#compresassub').val(compresas.innerHTML);
        $('#torundassub').val(tornudas.innerHTML);
        $('#gasassub').val(gasas.innerHTML);
        $('#mechassub').val(mechas.innerHTML);
        $('#agujassub').val(agujas.innerHTML);
        
            $('#endoperation').submit();
        }

        
        addEventListener("DOMContentLoaded", setInterval(update, 1000));

    </script>
@endsection