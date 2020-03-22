<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@if(isset($paciente)){{ $paciente->nombre.' '.$paciente->apellidos }}@endif</title>
    <style>
        @page{
            margin: 0cm 0cm;
        },
        body{
            margin: 2cm;
            font-family: Arial, Helvetica, sans-serif;
        },
        .logotop{
            position: fixed;
            width: 20cm;
            height: 6cm;
            margin-left:0.7cm;
            margin-top: 1.5cm;
            opacity: 0.2;
        },
        .logo{
            position: fixed;
            margin-left: 1cm;
            margin-top: 0.5cm;
            width: 5cm;
        },
        .nombredoctor{
            position: fixed;
            margin-left: 1.2cm;
            margin-top: 3.7cm;

        },
        .contactos{
            position: fixed;
            top:26.5cm;
            left:0.5cm;
            height: 6cm;

        },
        .infos{
            font-size: 12px;
        },
        .footer {
            position: fixed;
            top: 18cm;
            margin-left: 15cm;
            position: fixed;
            left:0.3cm;
        },
        .footer>img{

            height: 10cm;
            opacity: 0.2;
        },
        p{
            text-align: justify;
        }
        .paciente{
            position: fixed;
            border-radius: 35px ;
            background: #456EC6;
            opacity: 0.2;
            width: 20.5cm;
            height: 7cm;
            margin-left:0.5cm;
            margin-top: 0.2cm;
        },
        .detalle{
            position: fixed;
            border-radius: 35px ;
            border: 5px solid red;
            opacity: 0.2;
            width: 20cm;
            height: 16cm;
            margin-left:0.5cm;
            margin-top: 8cm;
        },
        .nombre{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            position: fixed;
            margin-left:10cm;
            margin-top: 3.6cm;
        },
        .fecha{
            margin-top:1cm;
            position:fixed;
            margin-left:16.5cm;
        },
        .direccion{
            margin-top:24.5cm;
            font-size: 10;
            position:fixed;
            margin-left:0.5cm;
            margin-right: 1cm;
        },
        .titulo{
            position: fixed;
            margin-top: 8.5cm;
            margin-left: 1cm;
            text-align: justify;
        },
        .receta{
            position: fixed;
            margin-top: 10cm;
            margin-left:1.4cm;
            text-align: justify;
        },
        .firma{
            position: fixed;
            top: 26cm;
            left: 17cm;
            text-align: center;
            font-size: 14px;
            color: rgb(120, 120, 120)
        }

    </style>
</head>
<body>
    <img src="{{public_path('adjuntosdoctor/lineavida.png')}}" alt="" class="logotop">
    <img src="{{public_path($doctor->logo)}}" alt="" class="logo">
    <p class="nombredoctor">@if($doctor->sexo=='hombre')
            Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} <br> <br> Código: {{$doctor->codigoDoctor}}
        @elseif($doctor->sexo=='mujer')
            Dra. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} <br> <br> Código: {{$doctor->codigoDoctor}}
        @endif
    </p>
    <div class="paciente">

    </div>
    <p class="fecha">FECHA: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    <p class="nombre"><strong>Paciente: </strong>@if(isset($paciente)){{$paciente->nombre.' '.$paciente->apellidos}}@endif</p>
    <div class="detalle">

    </div>

    <table>
        <tr>
            <td>
                <h3 class="titulo">
                    {{$receta->tituloReceta}}
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <p colspan="2" class="receta">
                    {!!$receta->descripcionReceta!!}
                </p>
            </td>
        </tr>
    </table>


    <table>
        <tr>
            <td>
                <p class="direccion">
                    <strong>Dirección: </strong><br>
                    {{$clinica->direccion}}
                </p>
            </td>
        </tr>
    </table>
    <div class="firma">
        <p>__________________</p>
        <p>FIRMA Y SELLO</p>
    </div>
    <div class="contactos">
        <table>
            <tr>
                @if($clinica->facebook!=null)
                <td> <img src="{{ public_path('adjuntosdoctor/fb.png') }}" alt="" width="20x" height="25x" ></td>
                <td><p class="infos">{{ $clinica->facebook }}</p></td>
                @endif
                <td> <img src="{{ public_path('adjuntosdoctor/tel.jpg') }}" alt="" width="20x" height="20x" ></td>
                <td><p class="infos">{{ $clinica->telefonos }}</p></td>
                @if($clinica->email!=null)
                <td> <img src="{{ public_path('adjuntosdoctor/email.png') }}" alt="" width="20x" height="20x" ></td>
                <td><p class="infos">{{ $clinica->email }}</p></td>
                @endif

            </tr>
        </table>
    </div>
</body>
</html>
