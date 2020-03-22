<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pacientes->nombre.' '.$pacientes->apellidos}}</title>
    <style>
        @page{
            margin: 0;
            padding: 0;
        }
        header{
            padding: 0.7cm;
            position: fixed;
            top:0;
            height: 2cm;
        }
        p{
            margin: 0;
            font-style: italic;
        }
        .fecha{
            float: right;
            font-style: italic;
        }
        footer{
            padding: 0.7cm;
            position: fixed;
            bottom: 0;
            height: 2cm;
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
        .icon{
            width: 20px;
            margin-left: 5px;
            margin-top: 5px;
            margin-right: 3px;
            height: 20px;
        }
        main{
            padding: 0.7cm;
            position: absolute;
            width: 100%;
            margin: 3.5cm 0cm 3.5cm 0cm;
        }
        .desc{
            text-align:center;
        }
        table{
            border: 5px double #123658;
            border-radius: 10px;
            padding: 0.2cm;
        }
        .nombre-proc{
            margin: 0;
            text-align: center;
            color: #3449A5 ;
            text-transform: uppercase;
        }
        .header-border{
            border: 5px outset #000;
            border-radius:10px;
            padding: 0.1cm;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-border">
            <p><b>Paciente: </b>{{$pacientes->nombre.' '.$pacientes->apellidos}} <span class="fecha">{{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</span></p>
            <p><b>Sexo: </b>@if($pacientes->sexo=='M')Masculino @else Femenino @endif</p>
            <p><b>Edad: </b>{{$edad}} años</p>
        </div>
    </header>
    <main>
            <h2  class="nombre-proc">Capturas de {{$tipo->procedimiento_nombre }}</h2>
        <table>
            <tr>
                @isset($img[0])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[0] }}</p></td>@endisset
                @isset($img[1])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[1] }}</p></td>@endisset
                @isset($img[2])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[2] }}</p></td>@endisset
            </tr>
            <tr>
                @isset($img[3])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[3] }}</p></td>@endisset
                @isset($img[4])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[4] }}</p></td>@endisset
                @isset($img[5])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[5] }}</p></td>@endisset
            </tr>
            <tr>
                @isset($img[6])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[6]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[6] }}</p></td>@endisset
                @isset($img[7])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[7]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[7] }}</p></td>@endisset
                @isset($img[8])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[8]}}" height="200px" width="245" alt=""><p class="desc">{{ $des[8] }}</p></td>@endisset
            </tr>
        </table>
    </main>
    <footer>
        <div class="redes">
            @if($clinica->email!=null) <span><img src="{{public_path('iconospdf/email.png')}}" class="icon" alt=""> {{$clinica->email}}</span>@endif 
            @if($clinica->paginaWeb!=null) <span><img src="{{public_path('iconospdf/web.png')}}" class="icon" alt=""> {{$clinica->paginaWeb}}</span>@endif
            @if($clinica->facebook!=null) <span><img src="{{public_path('iconospdf/facebook.png')}}" class="icon" alt=""> {{$clinica->facebook}}</span>@endif 
            @if($clinica->instagram!=null) <span><img src="{{public_path('iconospdf/instagram.png')}}" class="icon" alt=""> {{$clinica->instagram}}</span>@endif
        </div>
        <p class="siimed">SISTEMAS DE INTEGRACION MEDICA <span style="color:#4B4DC5">SIIMED</span></p>
    </footer>
</body>
</html>