<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receta Médica</title>
</head>
<style>
    html{
        margin:0;
        padding:0;
    },
    body{
        font-family: "Times New Roman", serif;
    }
    .line-top{
        height: 10px;
        background-color: rgb(9, 72, 169 );
        color:rgb(9, 72, 169);
        position: fixed;
    }
    .footer {
        position: fixed;
        top: 27cm;
        position: fixed;
        left:0.3cm;
    },

    .logo{
        top: 1cm;
        position: fixed;
        width: 14cm;
        height: 7cm;
    },
    .info
    {
        position: fixed;
        top: 1cm;
        left:8cm;
        top: 3cm;
    },
    .contactos{
        position: fixed;
        top:1cm;
        left:14cm;
        border-left:2px dotted gray;
        height: 6cm;
        padding-left: 0.5cm;

    },
    .bold{
        font-weight: bold;
        margin: 0.1cm;
    },
    p{
        margin: 0.1cm;
    }
    .text-small{
        font-size: 12px;
    },
    .slogan{
        width: 7cm;
    },
    .paciente{
        position: fixed;
        top:8cm;
    },
    .fecha{
        top: 1cm;
        margin-left: 8cm;
    },
    .pacient{
        margin-top: 0.5cm;
        margin-left: 2cm;
    },
    .watermaker{
        margin-left: 1cm;
        margin-top: 7cm;
        height: 16cm;
        opacity: 0.2;
        width: 19.5cm;
        z-index: -1000;
    },
    .infos{
        font-size: 12px;
    },

    .texto{
        position: fixed;
        margin-top: 12cm;
        margin-left: 2cm;
        margin-right: 2cm;
    },
    .time{
        position: fixed;
        margin-top:8cm;
        margin-left: 11cm;
    }
    .nombre{
        position: fixed;
        margin-top:9cm;
        margin-left: 6cm;
    }
    

</style>

<body>
    <hr class="line-top">
    <img src="{{ public_path('adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/logo2.png')}}" alt="" class="logo">
    <img src="{{ public_path('adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/'.$doctor->logo) }}" alt="" class="watermaker">
    <div class="contactos">
       <table>
            <tr>
               <td> <img src="{{ public_path('adjuntosdoctor/ubicacion.png') }}" alt="" width="20x" height="20x" ></td>
               <td><p class="infos">{{ $doctor->direccion }}</p></td>
            </tr>
            <tr>
               <td> <img src="{{ public_path('adjuntosdoctor/fb.png') }}" alt="" width="20x" height="25x" ></td>
               <td><p class="infos">{{ $doctor->facebook }}</p></td>
            </tr>
            <tr>
               <td> <img src="{{ public_path('adjuntosdoctor/tel.jpg') }}" alt="" width="20x" height="20x" ></td>
               <td><p class="infos">{{ $doctor->telefono }}</p></td>
            </tr>
            <tr>
                <td> <img src="{{ public_path('adjuntosdoctor/cel.png') }}" alt="" width="20x" height="20x" ></td>
                <td><p class="infos">{{ $doctor->telefono }}</p></td>
            </tr>
            {{-- por si se agrega web
            <tr>
               <td> <img src="{{ public_path('adjuntosdoctor/puntero.png') }}" alt="" width="20x" height="20x" ></td>
               <td><p class="infos">{{ $doctor->web }}</p></td>
            </tr> --}}
            <tr>
               <td> <img src="{{ public_path('adjuntosdoctor/email.png') }}" alt="" width="20x" height="20x" ></td>
               <td><p class="infos">{{ Auth::user()->email }}</p></td>
            </tr>
       </table>
    </div>
    <div class="texto">
        <h2>{{ $receta->tituloReceta }}</h2>
        <strong>RP:</strong><br>
        <p >{!! $receta->descripcionReceta !!}</div>
    <div class="paciente">
        <div class="time">{{ \Carbon\Carbon::now() }}</div>
        @if($paciente)
        <div class="nombre"> {{$paciente->nombre.' '.$paciente->apellidos}}</div>
        @endif
        <p class="fecha"><strong>FECHA:_____________________________________________________</strong></p>
        <p class="pacient"><strong>PACIENTE:______________________________________________________________________________</strong></p>
    </div>
    <div class="footer">
        <img src="{{ public_path('adjuntosdoctor/linebottom.png') }}" alt="">
    </div>
</html>
