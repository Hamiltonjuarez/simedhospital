<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
            @page{
                margin: 1cm;
                padding: 1cm;
            }
           .dv-header{
               height: 15%;
           }
           .logo{
               position: fixed;
               top: 0;
               width: 30%;
               text-align: center;
               height: 15%;
           }
           .image-logo{
               max-height: 15%;
               max-width: 100%;
           }
           .dv-titulo{
            position: fixed;
            top:0;
            left:32%;
            right: 0;
            padding: 0.2cm;
            font-family::Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
           }
           .clinica{
               margin-top: 3%;
           }
           .tipo{
               text-transform: uppercase;
               text-align:center;
           }
           .fecha{
               position: fixed;
               top: 0%;
               font-style: italic;
               right: 0%;
               left: 65%;
               font-size: 15px;
           }
           .lineUno{
            border: 2px  dotted #154B91;
           }
           .info-paciente{
               position: fixed;
               top: 30%;
               width: 80%;
               margin:auto;
               text-align: justify;
           }
           p{
            line-height:35px;
           }
           .nombre-paciente{
               width: 80%;
           }
           .edad-paciente{
                width: 20%;
           }
           .diagnostico{
               width: 80%;
               margin: auto;
               height: auto;
           }
           .titulos{
               width: 20%;
               vertical-align: text-top;
               border-top:solid #1441A9 2px ;
               font: bold 15px;
           }
           .descripciones{
               width: 80%;
               text-align: justify;
               padding-left: 1%;
               padding-right: 1%;
               border-top:solid #1441A9 2px ;
               border-radius: 0px 15px 15px 0px ;
               
           }
           /* .fila{
                border: #1441A9 1px solid;
               border-radius: 15px;
           } */
           .doctor-nombre{
               position: fixed;
               top: 85%;
               width: 100%;
           }
           .footer{
               position: fixed;
               top: 94.5%;
               float: right;
               font-size: 10px;
           }
           .logo-footer{
               color: #1441A9;
           }

    </style>
    </head>
    <body>
        <div class="dv-header">
            <div class="logo">
                <img src="{{ public_path($doctor->logo) }}" class="image-logo" alt="Logo">
            </div>
            <div class="dv-titulo">
                <h2 class="clinica">{{$clinica->nombreClinica}}</h2>
            </div>
            <span class="fecha">  {{ \Carbon\Carbon::parse($anexo->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</span>
        </div>
        @if($doctor->codigoDoctor!=null)<span style="margin-left:85%">JVPM: {{$doctor->codigoDoctor}}</span>@endif
        <hr>
        <table class="info-paciente">
            <tr>
                <td><h3 class="tipo"> {{$anexo->tipo}} MÉDICA</h3></td>
            </tr>
            <tr>
                <td>
                    <p>El suscrito Médico: <u>{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</u> hace constar
                    que @if($paciente->sexo == 'F')la @else el @endif paciente: <u>{{$paciente->nombre.' '.$paciente->apellidos}}</u>, 
                    @if($anexo->ingresodesde!=null)estuvo hospitalizado(a) en este centro del <u>{{\Carbon\Carbon::parse($anexo->ingresodesde)->locale('es_Es')->isoFormat('dddd, LL')}}</u> al 
                    <u>{{\Carbon\Carbon::parse($anexo->ingresohasta)->locale('es_Es')->isoFormat('dddd, LL') }}</u>@else consultó el día {{\Carbon\Carbon::now()->locale('es_Es')->isoFormat('dddd, LL') }}@endif; 
                    con diagnóstico de: <u>{{$anexo->diagnostico}}</u>, motivo por el cual se le reconoce un periodo de incapacidad durante: 
                    <u>@if($anexo->ingresodesde!=null){{Carbon\Carbon::parse(strtotime ( '-2 day' , strtotime ( $anexo->ingresodesde ) ))->diffInDays($anexo->hasta)}}@else {{Carbon\Carbon::parse(strtotime ( '-2 day' , strtotime ( $anexo->desde ) ))->diffInDays($anexo->hasta)}}@endif días</u>, a partir del día de su @if($anexo->ingresodesde!=null)ingreso @else consulta @endif a este hospital.</p>
                </td>
            </tr>
        </table>
      
        <table  class="doctor-nombre">
            <tr>
                <td class="firmasello" style="text-align:center">
                    <p style="font: bold 15px;">_____________________________<br>
                    &nbsp;&nbsp;Firma y sello</p>
                </td>
            </tr>
        </table>
        <div class="footer">
            SISTEMA DE INTEGRACION MEDICA <span class="logo-footer">(SIIMED)</span>
        </div>

        
    </body>
</html>