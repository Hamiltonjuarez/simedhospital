<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pacientes->nombre }}</title>
    <style>
        @page{
            margin: 0px;
        }
        body{
            margin: 0.7cm;
        }
        table {
            margin-bottom: 0px;
        }
        p {
            margin: 0px;
        }

        h1, h2, h3{
            margin: 0px;
            text-align: center;

        }
        h1{
            font-size: 20px;
            text-decoration: underline;
            color: #368BB6 ;
        }
        h2 {
            font-size: 12x;
            color: #47AB2C;
        }
        h3{
            font-size: 12px;
            font-weight: normal;
        }
        h4{
            margin: 0px;
        }
        .data {
            border: 1px solid #000;
        }

        .data td{
            font-weight: bold;
        }
        .data span{
            font-weight: normal;
            padding-left: 2px;
            padding-right: 5px;
        },
        .imagenes{
            border: 1px solid #000;
            margin-top: 0cm;
            vertical-align:bottom;
        }
        .imagenes p{
            background-color: black;
            color: white;
            text-align: center;
            font-size: 10;
            vertical-align: top;
        }
        .descripcion{
            border: 1px solid #000;
            font-size: 13px;
            padding: 5px;
            vertical-align: top;
        }

        .firma{
            text-align: center;
            position: absolute;
        }
        .line{
            text-align: center;
            position: absolute;
            top: 930px;
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
        .logoSecond{
            position: fixed;
            top: 1.5cm;
            left: 18cm;
            z-index: -1000;
        },
        .img-footer{
            position: fixed;
            left: 2cm;
            top: 25.5cm;
            width: 17cm;
            height: 2cm;
        }
         .firma{
            position: fixed;
            top: 26.2cm;
            text-align: center;
            font-size: 14px;
            color: rgb(120, 120, 120)
        }
        .footer-left{
            position:fixed;
            top:26cm;
            height:50px;
            left:2cm;
        }
         .footer-right{
            position:fixed;
            top:26cm;
            height:50px;
            left:16cm;
        }
        .header{
            margin-top:0;
        }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td width="100"> <img src="{{ public_path($doctor->logo)}}" width="200" height="200" alt=""> </td>
            <td width="336">
                <h1> {{$doctor->tituloDoctor}} </h1>
                <h2>Cirujano Endoscopista</h2>

                <h3>{{$clinica->direccion}}</h3>
                <h3> Telefono: {{$clinica->telefonos}} | Celular: {{$clinica->celular}} </h3>
                @if($clinica->email!=null)
                <h3> {{-- {{$clinica->email}} --}}</h3>
                @endif
            </td>
            <td width="100"></td>
        </tr>
    </table>

    {{-- 536 without border (530.1) (527.2) (524.3) (515.4) (521.5) 3px eachborder --}}
    <table class="data">
        <tr >
            <td width="298">
                PROCEDIMIENTO: {{ $tipo->procedimiento_nombre }}
            </td>

            <td width="238" colspan="2">
                {{-- {{ $tipo->procedimiento_nombre }} Número: <span>{{ $procedimiento->id }}</span> --}}
                Fecha: <span> {{$fecha['fecha']}} </span>
            </td>
        </tr>
        <tr>
            <td width="298">
                Paciente: <span>{{$pacientes->nombre.' '.$pacientes->apellidos}}</span>
            </td>
            <td width="119">
                Edad: <span>{{$edad}} años</span>
            </td>
            <td width="119">
                Sexo: <span>{{ $pacientes->sexo }}</span>
            </td>
        </tr>
    </table>




    <table class="imagenes">
        <tr>
            <td width="178">
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="237" height="172" alt="">
                <p>{{ $des[0] }}</p>
            </td>
            <td width="178"><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="237" height="172" alt="">
                <p>{{ $des[1] }}</p>
            </td>
            <td width="179"><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="237" height="172" alt="">
                <p>{{ $des[2] }}</p>
            </td>
        </tr>
        <tr>
            <td width="178">
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="237" height="172" alt="">
                <p>{{ $des[3] }}</p>
            </td>
            <td width="178">
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" width="237" height="172" alt="">
                <p>{{ $des[4] }}</p>
            </td>
            <td width="179">
                <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" width="237" height="172" alt="">
                <p>{{ $des[5] }}</p>
            </td>
        </tr>
    </table>
    <table width="549">
        <tr >
            <td class="descripcion" height="60">
                    {!! $procedimiento->contenido !!}
            </td>
        </tr>
    </table>
    <div class="footer">
         <div class="firma">
            <p>____________________</p>
            <p>FIRMA Y SELLO</p>
        </div>
        <img src="{{public_path('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/footerleft.png')}}" class="footer-left" alt="">
        <img src="{{public_path('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/footerright.png')}}" class="footer-right" alt="">
    </div>
</body>
</html>
