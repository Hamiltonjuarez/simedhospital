<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pacientes->nombre.' '.$pacientes->apellidos}}</title>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }
    
        body {
            margin: 2cm 0cm 2cm 0cm;
        }
        main{
            margin-top: 4cm;
            padding: 0cm 0.7cm 0cm 0.7cm;
            max-height: 23.3cm;
            color: #000;
            page-break-after: always;
        }
        
    
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            color: black;
            padding: 0.7cm 0.7cm 0cm 0.7cm;
           
        }
    
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #FFF;
            color: black;
            font-size: 12px;
            padding: 0.1cm 0.7cm 0.7cm 0.7cm;
        }
        .logo{
            max-width: 6cm;
            position: absolute;
            height: 4cm;
        }
        .img-logo{
            margin-top: 0cm;
            width: 6cm;
            border-radius: 5px;
            box-shadow: 5px 10px;
            max-height:4cm;
        }
        .info-header{
            position: relative;
            left: 5.2cm;
            width: 14.5cm;
            height: 4.5cm;
            color: #000;
            padding: 5px;
            /* border: 5px double blue;
            border-radius: 10px; */
        }
        .fecha{
            margin-left: 8.3cm;
            font-style:oblique; 
            color: black;
        }
        .clinica{
            text-align: center;
            margin: 4px;
            color: black;
            text-transform: uppercase;
        }
        .direccion{
            margin: 5px;
            font-size: 15px;
            font-style: italic;
            text-align: center;
            color: black;
        }
        .telefonos{
            font-size: 13px;
            font-style: initial;
            text-align: center;
            margin: 2px;
            color: black;
        }
        .icon{
            width: 20px;
            margin-left: 5px;
            margin-top: 5px;
            margin-right: 3px;
            height: 20px;
        }
        .doctor{
            font-style:normal;
            text-align: center;
            color: black;
        }
        .paciente{
            color: #000;
            border: 5px outset #44B6D2  ;
            font-size: 17px;
            padding: 0.1cm;
            margin: 0;
        }
        .p-paciente{
            margin: 0;
        }
        .nombre-paciente{
            position: relative;
        }
        .edad{
            margin-right: 0cm;
            float: right;
        }
        p{
            margin: 0;
        }
        .sexo{
            margin-left: 3cm;
        }
        .descripcion{
            border: 5px double #44B6D2;
            padding: 0.1cm;
            margin-top: 0.5cm;
            border-radius: 10px;
            height: 13cm;
            font-size: 12px;
        }
        .redes{
            width: 100%;
            text-align: center;
            color: #000;
        }
        .siimed{
            color: #000;
            text-align: center;
            margin-top: 1cm;
        }
        .main2{
            margin-top: 3cm;
            padding: 0.7cm
        }
        .fotos{
            border: 5px double #123964;
            border-radius: 10px;
        }
        .desc{
            text-align: center;
        }
        .nombre-proc{
            margin: 0;
            text-align: center;
            color: #000;
            text-transform: uppercase;
        }
        .firma{
            position: fixed;
            top: 23.8cm;
            text-align: center;
            font-size: 14px;
            color: rgb(120, 120, 120)
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="{{route('home')}}"><img src="{{ public_path($doctor->logo) }}" class="img-logo"></a>
        </div>
        <div class="info-header">
            <span class="fecha"> {{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</span>
            <h3 class="clinica">REPORTE DE {{$tipo->procedimiento_nombre }}</h3>
            <p class="direccion"><img src="{{public_path('iconospdf/direccion.png')}}" class="icon" alt="">{{$clinica->direccion}}</p>
            <p class="telefonos"><img src="{{public_path('iconospdf/telefono.png')}}" class="icon" alt=""><strong>{{$clinica->telefonos}} @if($clinica->celular!=null) <span><img src="{{public_path('iconospdf/whatsapp.png')}}" class="icon" alt=""> {{$clinica->celular}}</span>@endif</strong></p>
            <p class="doctor">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} </p>
        </div>
    </header>
    <footer>
        <div class="redes">
            @if($clinica->email!=null) <span><img src="{{public_path('iconospdf/email.png')}}" class="icon" alt=""> {{$clinica->email}}</span>@endif 
            @if($clinica->paginaWeb!=null) <span><img src="{{public_path('iconospdf/web.png')}}" class="icon" alt=""> {{$clinica->paginaWeb}}</span>@endif
            @if($clinica->facebook!=null) <span><img src="{{public_path('iconospdf/facebook.png')}}" class="icon" alt=""> {{$clinica->facebook}}</span>@endif 
            @if($clinica->instagram!=null) <span><img src="{{public_path('iconospdf/instagram.png')}}" class="icon" alt=""> {{$clinica->instagram}}</span>@endif
        </div>
        <p class="siimed">SISTEMAS DE INTEGRACION MEDICA <span style="color:#4B4DC5">SIMED</span></p>
    </footer>
    <main>
        <div class="paciente">
            <p class="p-paciente"><span class="nombre-paciente"><strong>PACIENTE:</strong> {{$pacientes->nombre.' '.$pacientes->apellidos}}</span> <span ><strong class="sexo">SEXO:</strong> @if($pacientes->sexo=='M')Masculino @else Femenino @endif</span><span class="edad"><strong>EDAD:</strong> {{$edad}} años</span></p>
        </div>
        <div class="descripcion">
            <p>{!!$procedimiento->contenido!!}</p>
        </div>
        <div class="firma">
            <p>____________________</p>
            <p>FIRMA Y SELLO</p>
        </div>
    </main>
    <div class="main2">
        <h2  class="nombre-proc">Capturas de {{$tipo->procedimiento_nombre }}</h2>
      <div class="fotos">
            <table>
                <tr>
                    @isset($img[0]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" height="200px" width="245" alt=""> @endisset  @isset($des[0])<p class="desc">{{ $des[0] }}</p></td> @endisset
                    @isset($img[1]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" height="200px" width="245" alt=""> @endisset  @isset($des[1])<p class="desc">{{ $des[1] }}</p></td> @endisset
                    @isset($img[2]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" height="200px" width="245" alt=""> @endisset  @isset($des[2])<p class="desc">{{ $des[2] }}</p></td> @endisset
                </tr>
                <tr>
                    @isset($img[3]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" height="200px" width="245" alt=""> @endisset  @isset($des[3])<p class="desc">{{ $des[3] }}</p></td> @endisset
                    @isset($img[4]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" height="200px" width="245" alt=""> @endisset  @isset($des[4])<p class="desc">{{ $des[4] }}</p></td> @endisset
                    @isset($img[5]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" height="200px" width="245" alt=""> @endisset  @isset($des[5])<p class="desc">{{ $des[5] }}</p></td> @endisset
                </tr>
                <tr>
                    @isset($img[6]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[6]}}" height="200px" width="245" alt=""> @endisset  @isset($des[6])<p class="desc">{{ $des[6] }}</p></td> @endisset
                    @isset($img[7]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[7]}}" height="200px" width="245" alt=""> @endisset  @isset($des[7])<p class="desc">{{ $des[7] }}</p></td> @endisset
                    @isset($img[8]) <td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[8]}}" height="200px" width="245" alt=""> @endisset  @isset($des[8])<p class="desc">{{ $des[8] }}</p></td> @endisset
                </tr>
            </table>
      </div>
    </div>
    
   
</body>
</html>