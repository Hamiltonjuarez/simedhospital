<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pacientes->nombre.' '.$pacientes->apellidos }}</title>
    <style>
        table {
            margin-bottom: 10px;
            margin-left: 20px;
            margin-right: 20px;
        }
        p {
            margin: 0px;
        }

        h1, h2, h3{
            margin: 0px;
            text-align: center;
            /* color: rgb(0, 150, 150) */
        }
        h1{
            font-size: 24px;
            /* text-decoration: underline; */
        }
        h2 {
            font-size: 14px;
        }
        h3{
            font-size: 14px;
            font-weight: normal;
        }
        h4{
            margin: 0px;
        }     
        .page-break{
            page-break-before: always;
        }
        .header{
            text-align: center;
        }   
        
        .data td{
            height: 20px;
        }
        .data span{
            font-weight: normal;
            /* border: 1px solid rgb(200, 150, 0); */
            padding-left: 2px;
            padding-right: 5px;
        }

        .imagenes{
            margin-top: 35px;
            text-align: center;
        }
        .descripcion{
            /* border: 1px solid rgb(200, 150, 0); */
            padding: 5px;
            font-size: 14px;
        }
        .logoss img{
            float:left;
        }

        .firma{
            text-align: center;
            position: absolute;
            top: 900px;
        }
        .main{
            width: 100%;
            height: 99%;
            border: 1px solid black;
            position: absolute;
        }
    </style>
</head>
<body>
    
        <table class="header">
                <tr>
                    <td> <img src="{{public_path($doctor->logo)}}" width="100" alt=""> </td>
                </tr>
                <tr>
                    <td width="496">
                        <h3>{{$doctor->direccion}}</h3>
                        <h3>{{$doctor->telefono}}</h3>
                    </td>
                </tr>
            </table>
            <table class="header">
                <tr>
                    <td width="496">
                        <h1 style="color:blue">Informe de {{ $tipo->procedimiento_nombre }}</h1>
                    </td>
                </tr>
            </table>
        
            {{-- 536 without border (530.1) (527.2) (524.3) (515.4) (521.5) 3px eachborder --}} 
            <table class="data">
                <tr>
                    <td width="248">
                        <b>Fecha:</b>  {{ $fecha['fecha'] }}
                    </td>
                </tr>
                <tr>
                    <td width="248">
                        <b>Paciente:</b> {{ $pacientes->nombre.' '.$pacientes->apellidos }}
                    </td>
                    <td width="124">
                        <b>Edad:</b> {{ $edad }}
                    </td>
                    <td width="124">
                        <b>Sexo:</b> {{ $pacientes->sexo }}
                    </td>
                </tr>
            </table>
        
                
            <table width="525">
                <tr>
                    <td class="descripcion">
                            {!! $procedimiento->contenido !!}
                    </td>
                </tr>
            </table>

    <div class="page-break"></div>
    
   

    <table class="imagenes">
            
            <tr>
                <td colspan="3">
                    Imágenes de la {{ $tipo->procedimiento_nombre }}:
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td>
                    <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="300" height="220" alt="">
                </td>
                <td width="12">&nbsp;</td>
                <td>
                    <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="300" height="220" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="300" height="220" alt="">
                </td>
                <td width="12">&nbsp;</td>
                <td>
                    <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="300" height="220" alt="">
                </td>
            </tr>
        </table>

        <div class="firma">
                <h3>Firma: _______________________________</h3>
                <h4>  {{ $doctor->tituloDoctor }}</h4>
        </div>
</body>
</html>