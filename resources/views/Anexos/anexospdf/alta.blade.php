<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
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
               margin-top: 2%;
           }
           .tipo{
               text-transform: uppercase;
               text-align:center;
           }
           .fecha{
               position: fixed;
               top: 0%;
               right: 0%;
               left: 65%;
               font-size: 15px;
           }
           .lineUno{
            border: 2px  dotted #154B91;
           }
           .info-paciente{
               width: 80%;
               margin:auto;
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
                <img src="{{public_path($doctor->logo) }}" class="image-logo" alt="Logo">
            </div>
            <div class="dv-titulo">
                <h2 class="clinica">{{$clinica->nombreClinica}}</h2>
            </div>
            <span class="fecha">  {{ \Carbon\Carbon::parse($anexo->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</span>
        </div>
        
        <hr>
        <table class="info-paciente">
            <tr>
                <td><h3 class="tipo">HOJA DE {{$anexo->tipo}}</h3></td>
            </tr>
            <tr>
                <td class="nombre-paciente"><strong>Paciente:</strong> {{$paciente->nombre.' '.$paciente->apellidos}}</td>
                <td class="edad-paciente"><strong>Edad:</strong> {{$paciente->getAgeAttribute()}} años</td>
            </tr>
            <tr>
                <td>
                    <strong>Estado de alta del paciente: </strong>{{$anexo->estado_alta}}
                </td>
            </tr>
        </table>
        <hr>
        <table class="diagnostico">
            @if($anexo->diagnostico)
            <tr class="fila">
                <td class="titulos">
                    <p>Diagnóstico:</p>
                </td>
                <td class="descripciones">
                    <p>{!!$anexo->diagnostico!!}</p>
                </td>
            </tr>
            @endif
            @if($anexo->tratamiento)
            <tr class="fila">
                <td class="titulos">
                    <p>Tratamiento:</p>
                </td>
                <td class="descripciones">
                    <p>{!!$anexo->tratamiento!!}</p>
                </td>
            </tr>
            @endif
            @if($anexo->agregados)
            <tr class="fila">
                <td class="titulos">
                    <p>Instrucciones:</p>
                </td>
                <td class="descripciones">
                    <p>{!!$anexo->agregados!!}</p>
                </td>
            </tr>
            @endif
        </table>
        <table  class="doctor-nombre">
            <tr>
                <td>
                    <p style="font: bold 15px;">_____________________________________<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Doctor que firma el {{$anexo->tipo}}</p>
                </td>
                <td class="firmasello">
                    <p style="font: bold 15px;">_____________________________<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma y sello</p>
                </td>
            </tr>
        </table>
        <div class="footer">
            SISTEMA DE INTEGRACION MEDICA <span class="logo-footer">(SIIMED)</span>
        </div>

        
    </body>
</html>