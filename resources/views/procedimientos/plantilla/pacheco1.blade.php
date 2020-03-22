<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pacientes->nombre.' '.$pacientes->apellidos }}</title>
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
            left: 1.2cm;
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
        p{
            margin: 0.1cm;
        }
        .text-small{
            font-size: 12px;
        }
        
        .main_table{
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
            height: 8cm;
            vertical-align: top;
        }
        .col-15{
            width: 15cm;
        }
        .footer-left{
            text-align: center;
            width: 8.7cm;
            font-size: 13px;
            position: fixed;
            top: 25.5cm;
            left: 1cm;
        }
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
        p span{
            font-weight: bold;
        }
        a{
            text-decoration: none;
            color: black
        }
        .bold{
            font-weight: bold;
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
    </style>
</head>
<body>
    <div class="header-left">
        <img src="{{ public_path($doctor->logo) }}" width="250" >
        <p class="bold">CLÍNICA DE CIRUGÍAS Y ENFERMEDADES DIGESTIVAS</p>
        <p style="text-transform:uppercase">{{ $doctor->tituloDoctor }} | JVPM 7370</p>
    </div>
    <img src="{{ asset('procedimientos/plantilla/pacheco/watermaker1.png') }}" class="watermaker" >
    
    <div class="footer-right">
        <p><img src="{{ asset('procedimientos/plantilla/pacheco/facebook.png') }}" height="14px" > </p>
        <p><img src="{{ asset('procedimientos/plantilla/pacheco/web-icon.png') }}" height="14px"> </p>
    </div>
    <div class="footer-right-text">
        
        {{--<p>Sonodigest - {{ $doc[0].' '.$doc[1].' '.$doc[2].' '.$doc[3] }}</p>--}}
        <p>
            <a href="http://www.sonodigest.com">www.sonodigest.com</a>
        </p>
    </div>
    <div class="fecha">
        <p>FECHA: {{$fecha['fecha']}}</p>
    </div>
    <div class="header-right">
        <p class="bold">MIEMBRO DE:</p>
        <p class="text-small">Colegio Médico de El Salvador</p>
        <p class="text-small">Asociación Salvadoreña de Cirugía General</p>
        <p class="text-small">Asociación de Cirugía Endoscópica de El Salvador</p>
    </div>
    
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
    <table class="main_table">
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
            <td colspan="2" height="280"></td>
        </tr>
        <tr>
            <td colspan="2" class="contenido">
                {!! $procedimiento->contenido !!}
            </td>
        </tr>
    </table>

    <div class="imgTop">
       @isset($img[0]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" alt=""> @endisset
       @isset($img[1]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" alt="">@endisset
        @insset(img[2])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" alt="">@endisset
    </div>
    
    <div class="imgBottom">
       @isset(img[3]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" alt=""> @endisset
        @isset($img[4])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" alt="">@endisset
        @isset($img[5])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" alt="">@endisset
    </div>

   @if($des[0] != null) <div class="txt1">{{ $des[0] }}</div> @else <p class="txt1"></p> @endif
    @if($des[1] != null) <div class="txt2">{{ $des[1] }}</div> @else <p class="txt2"></p> @endif
    @if($des[2] != null) <div class="txt3">{{ $des[2] }}</div> @else <p class="txt3"></p> @endif
    @if($des[3] != null) <div class="txt4">{{ $des[3] }}</div> @else <p class="txt4"></p> @endif
    @if($des[4] != null) <div class="txt5">{{ $des[4] }}</div> @else <p class="txt5"></p> @endif
    @if($des[5] != null) <div class="txt6">{{ $des[5] }}</div> @else <p class="txt6"></p> @endif

    <div class="firma">
        <p>____________________</p>
        <p>FIRMA Y SELLO</p>
    </div>
    <div class="footer-left">
        <p> <span>SUCURSAL ESCALÓN</span> </p>
        <p>Col. Escalón calle Cuscatlán N° 448, entre 83 y 85 Av.
                Sur San Salvador. <span>Tel. (503) 2519 2857 | 7749 0041</span> </p>
    </div>
    
</body>
</html>