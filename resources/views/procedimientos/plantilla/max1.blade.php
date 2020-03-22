<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pacientes->nombre.' '.$pacientes->apellidos }}</title>
    <style>
        table {
            margin-bottom: 10px;
        }
        p {
            margin: 0px;
        }

        h1, h2, h3{
            margin: 0px;
            text-align: center;
            color: rgb(0, 150, 150)
        }
        h1{
            font-size: 24px;
            text-decoration: underline;
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
        
        .data td{
            font-weight: bold;
        }
        .data span{
            font-weight: normal;
            border: 1px solid rgb(200, 150, 0);
            padding-left: 2px;
            padding-right: 5px;
        }
        .imagenes p{
            
            color: white;
            text-align: center;
            font-size: 10;
            vertical-align: top;
        }
        .imagenes td{
            vertical-align: top;
            background-color: black;
        }
        .descripcion{
            border: 1px solid rgb(200, 150, 0);
            padding: 5px;
            font-size: 13px;
            vertical-align: top;
        }

        .firma{
            text-align: center;
            position: absolute;
            top: 930px;
        }
        .line{
            text-align: center;
            position: absolute;
            top: 960px;
            width: 368px;
            left: 120;
        }
        .line-left{
            height: 3px;
            width: 50%;
            background-color: rgb(200, 150, 0);
            display: inline-block;
            margin: 0;
        }
        .line-right{
            height: 3px;
            width: 50%;
            background-color: rgb(0, 150, 150);
            display: inline-block;
            margin: 0;
        }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td width="100"> <img src="{{public_path($doctor->logo)}}" width="175" alt=""> </td>
            <td width="336">
                <h1>Informe de {{ $tipo->procedimiento_nombre }} </h1>
                <h2> {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} </h2>
                <h3> SIIMED </h3>
                <h3> {{$clinica->direccion}} </h3>
                <h3> TEL.: (503) {{$clinica->telefonos}} </h3>
            </td>
            <td width="100"></td>
        </tr>
    </table>

    {{-- 536 without border (530.1) (527.2) (524.3) (515.4) (521.5) 3px eachborder --}} 
    <table class="data">
        <tr>
            <td width="268">
                Fecha: <span> {{$fecha['fecha']}} </span>
            </td>
        </tr>
        <tr>
            <td width="268">
                Paciente: <span>{{$pacientes->nombre.' '.$pacientes->apellidos}}</span>
            </td>
            <td width="134">
                Edad: <span>{{$edad}} años</span>
            </td>
            <td width="134">
                Sexo: <span>{{ $pacientes->sexo }}</span>
            </td>
        </tr>
    </table>
    

    

    <table class="imagenes">
        <tr>
            <td>
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="237" height="172" alt="">
                <p>{{ $des[0] }}</p>
            </td>
            <td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="237" height="172" alt="">
                <p>{{ $des[1] }}</p>
            </td>
            <td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="237" height="172" alt="">
                <p>{{ $des[2] }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="237" height="172" alt="">
                <p>{{ $des[3] }}</p>
            </td>
            <td>
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" width="237" height="172" alt="">
                <p>{{ $des[4] }}</p>
            </td>
            <td>
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" width="237" height="172" alt="">
                <p>{{ $des[5] }}</p>
            </td>
        </tr>
    </table>
    <table width="545">
        <tr>
            <td class="descripcion" height="60">
                    {!! $procedimiento->contenido !!}
            </td>
        </tr>
    </table>
    <div class="firma">
        <h3>Firma: _______________________________</h3>
        <h4> {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} </h4>
    </div>
    <div class="line">
        <div class="line-left"></div>
        <div class="line-right"></div>
    </div>
</body>
</html>