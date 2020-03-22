<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page{
            margin: 0cm 0cm;
        }
        body{
            margin: 1cm;
            font-family: Arial, Helvetica, sans-serif;
        }
        .watermaker{
            position: fixed;
            top: 13cm;
            left: 1cm;
            width: 19.5cm;
            z-index: -1000;
        }
        label{
            position: fixed;
            top: 15cm;
            left: 10cm;
        }
        .header-left{
            position: fixed;
            top: 1cm;
            left: 0cm;
            font-size: 14px;
        }
        .fecha{
            width: 100%;
            text-align: right;
        }
        .header-right{
            position: fixed;
            top:2cm;
            left: 12cm;
        }
        .header-right p {
            margin: 1px;
        }
        p{
            margin: 0.1cm;
        }
        .text-small{
            font-size: 12px;
        }

        table{
            width: 100%;
            position: fixed;
            top: 5cm;
            left: 1cm;
            border-collapse: collapse;
        }
        td{
            padding: 5px;
            font-size: 12px;
            border: 1px solid rgb(150, 150, 150);
        }
        .table-title{
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }
        .contenido{
            padding-left: 7cm;
            height: 18.3cm;
            vertical-align: top;
        }
        .col-15{
            width: 15cm;
        }

        .footer-left{
            text-align: left;
            font-size: 13px;
            position: fixed;
            width: 10cm;
            top: 25.5cm;
            left: 1cm;
        }
        .footer-center{
            text-align: left;
            font-size: 13px;
            position: fixed;
            top: 25.5cm;
            left: 8cm;
        }
        .footer-left p{
            margin: 0px;
        }
        .footer-center p {
            margin: 0px;
        }

        /* logo de redes sociales */
        .footer-right{
            width: 6.5cm;
            position: fixed;
            top: 25.5cm;
            left: 13.6cm;
            font-size: 14px;
        }
        .footer-right p{
            margin: 10px;
        }
        /* texto de redes sociales */
        .footer-right-text{
            width: 6.5cm;
            position: fixed;
            top: 25.6cm;
            left: 14.5cm;
            font-size: 13px;
        }
        .footer-right-text p{
            margin: 6px;
        }

        /* texto formato */
        p span{
            font-weight: bold;
        }
        a{
            text-decoration: none;
            color: black
        }
        .bold{
            font-weight: bold;
            margin-left: 1cm;
        }
        .imgTop {
            position: fixed;
            top: 7.9cm;
            left: 1.1cm;
            z-index: -1000;
        }
        .txt1, .txt2, .txt3{
            position: fixed;
            top: 11.5cm;
            font-size: 12px;
            width: 6.4cm;
            text-align: center;
        }
        .txt1, .txt4{
            left: 1.1cm;
        }
        .txt2, .txt5{
            left: 7.6cm;
        }
        .txt3, .txt6{
            left: 14.1cm;
        }
        .txt4, .txt5, .txt6{
            position: fixed;
            top:16.6cm;
            font-size: 12px;
            width: 6.4cm;
            text-align: center;
        }


        .imgBottom{
            position: fixed;
            top: 13cm;
            left: 1.1cm;
            z-index: -1000;
        }
        .imgTop img, .imgBottom img {
            width: 6.38cm;
            height: 4.5cm;
        }
        .firma{
            position: fixed;
            top: 23.8cm;
            left: 14.5cm;
            text-align: center;
            font-size: 14px;
            color: rgb(120, 120, 120)
        }
        .imgv{
            position: fixed;
            top:7cm;
            left:1.2cm;
            z-index: -1000;
            font-size: 11px;
        }
        .imgv img{
            width: 6cm;
            height: 4cm;
        }
    </style>
</head>
<body>
    <div class="header-left">
        <img src="{{ public_path($doctor->logo) }}" width="300" height="75">
        <p class="bold" style="text-transform:uppercase">{{strtoupper($clinica->nombreClinica)}}</p>
        <p class="bold" style="text-transform:uppercase">{{ $procedimiento->doctorinvitado }} </p>
    </div>

    <div class="footer-right">
        @if($clinica->facebook != null)<p><img src="{{ public_path('procedimientos/plantilla/pacheco/facebook.png') }}" height="14px" > </p>@endif
        @if($clinica->paginaWeb != null)<p><img src="{{ public_path('procedimientos/plantilla/pacheco/web-icon.png') }}" height="14px"> </p>@endif
    </div>
    <div class="footer-right-text">
        @if($clinica->facebook != null)<a href="https://www.facebook.com/gastrocentro.com.sv/" ><p>{{$clinica->facebook}}</p></a>@endif
        @if($clinica->paginaWeb != null)<p>
            <a href="{{$clinica->paginaWeb}}"  >{{$clinica->paginaWeb}}</a>
        </p>@endif
    </div>
    <div class="fecha">
        <p>FECHA: {{$fecha['fecha']}}</p>
    </div>
    {{-- <div class="header-right">
        <p class="bold">MIEMBRO DE:</p>
        <p class="text-small">Asociación Salvadoreña de Cirugía</p>
        <p class="text-small">Asociación Salvadoreña de Flebología</p>
        <p class="text-small">Academia Mexicana de Flebología y Linfología</p>
        <p class="text-small">Asociación Panamericana de Flebología y Linfología</p>
        <p class="text-small">Unión Internacional de Flebología</p>

    </div> --}}

    {{-- <div class="container main">
        <div class="row">
            <div class="col-19">
                ULTRASONOGRAFÍA
            </div>
        </div>
        <div class="row">
            <div class="col-14">
                NOMBRE:
            </div>
            <div class="col-5">
                EDAD:
            </div>
        </div>
    </div> --}}
    <table>
        <tr>
            <td colspan="2" class="table-title">
                {{ $tipo->procedimiento_nombre }}
            </td>
        </tr>
        <tr>
            <td class="col-15">NOMBRE: {{ $pacientes->nombre.' '.$pacientes->apellidos }}</td>
            <td>EDAD: {{$edad}} años </td>
        </tr>
        <tr>
            <td colspan="2" class="contenido">
                {!! $procedimiento->contenido !!}
            </td>
        </tr>
    </table>

    <div class="imgv">
            <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" alt=""></p>
            <p>{{ $des[0] }}</p>
            <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" alt=""></p>
            <p>{{ $des[1] }}</p>
            <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" alt=""></p>
            <p>{{ $des[2] }}</p>
            <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" alt=""></p>
            <p>{{ $des[3] }}</p>
    </div>
    <div class="txt1">{{ $des[0] }}</div>
    <div class="txt2">{{ $des[1] }}</div>
    <div class="txt3">{{ $des[2] }}</div>
    <div class="txt4">{{ $des[3] }}</div>
    <div class="txt5">{{ $des[4] }}</div>
    <div class="txt6">{{ $des[5] }}</div>

    <div class="firma">
        <p>____________________</p>
        <p>FIRMA Y SELLO</p>
    </div>

    <div class="footer-left">
        {{-- <p> <span>SUCURSAL ESCALÓN</span> </p> --}}
        <p><span>Dirección:</span></p>
        <p>{{$clinica->direccion}}</p><br>
        <p><span>Tel. {{$clinica->telefonos}}</span></p>
        </p>
    </div>
    {{-- <div class="footer-center">
        <p> <span>SUCURSAL ESCALÓN</span> </p>
        <p>Boulevar Orden de Malta,</p>
        <p>Plaza Montecristo local #14.</p>
        <p><span>Tel. (503) 2519 5937 | 7989 6523</span></p>
    </div> --}}

</body>
</html>
