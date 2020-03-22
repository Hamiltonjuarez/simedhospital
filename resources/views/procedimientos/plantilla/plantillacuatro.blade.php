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
        body{
            border-top: black 5px solid;
            border-left: black 5px solid;
            border-right: black 5px solid;
        }
        header{
            position: relative;
            width: 100%;
            height: 4.5cm;
        }
        div.logo{
            position: absolute;
            top: 0.5cm;
            left: 0.5cm;
            width: 6cm;
            height: 3.9cm;
        }
        .img-logo{
            max-width: 6cm;
            max-height: 3.8cm;
        }
        div.info-header{
            position: absolute;
            top: 0.5cm;
            padding: 2px;
            left: 6.6cm;;
            width: 14.1cm;
            height: 3.9cm;
            line-height: 13px;
            border: #000 2px solid;
            border-radius: 5px;
        }
        .fecha{
            margin-left: 7cm;
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
        .doctor{
            text-align: center;
            color: black;
        }
        .icon{
            width: 15px;
            margin-left: 5px;
            margin-top: 0px;
            margin-right: 3px;
            height: 15px;
        }
        /* inicio cuerpo principal */
        main{
            position: relative;
            height: 19.7cm;
            width: 100%;
        }
        div.contenido{
            position: absolute;
            width: 12cm;
            top: 1.5cm;
            height: 18.5cm;
            text-align: justify;
            margin-left: 0.6cm;
            border: #000 3px solid;
            border-radius: 5px;
            padding: 5px;
        }
        div.procedimiento{
            margin-top: 5px;
            text-align: center;
            text-transform: uppercase;
            position: absolute;
            height: 0.6cm;
            width: 100%;
        }
        .titulo{
            margin: 0;
            padding: 0;
        }
        /*
        div.paciente{
            top: 0.8cm;
            height: 0.6cm;
            width: 100%;
            position: absolute;
            text-align: center;
        } */
        .sexo{
            margin-left: 30px;
        }
        .edad{
            margin-left: 30px;
        }
        div.images{
            top: 1.5cm;
            position: absolute;
            width: 7.5cm;
            left: 13.2cm;
            padding: 0;
        }
        div.imagen{
            padding: 0;
            margin: 0;
            position: relative;
        }
        .desc{
            padding: 0;
            margin: 0;
            position: relative;
            text-align: center;
        }
        .imgs{
            padding: 0;
            margin: 0;
            border-radius: 10px;
            position: relative;
            width: 100%;
            height: 178px;
        }
        /* fin cuerpo principal */

        /* inicio footer */
        footer{
            padding-left: 0.5cm;
            position: fixed;
            height: 3.4cm;
            width: 12.5cm;
            bottom: 0;
        }
        .firma{
            margin-top: 50px;
            text-align: center;
            color: grey;
        }
        
        .siimed{
            position: fixed;
            text-align: center;
            top: 27.2cm;
            font-style: italic;
            font-size: 12px;
        }
        /* fin footer */
    </style>
</head>
<body>
        <header>
                <div class="logo">
                        <a href="{{route('home')}}"><img src="{{ public_path($doctor->logo) }}" class="img-logo"></a>
                </div>
                <div class="info-header">
                    <span class="fecha" style="text-transform:capitalize;margin-top:5px"> {{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</span>
                    <h3 class="clinica"> {{$clinica->nombreClinica}}</h3>
                    <p class="direccion"><img src="{{public_path('iconospdf/direccion.png')}}" class="icon" alt="">{{$clinica->direccion}}</p>
                    <p class="telefonos"><img src="{{public_path('iconospdf/telefono.png')}}" class="icon" alt=""><strong>{{$clinica->telefonos}} @if($clinica->celular!=null) <span><img src="{{public_path('iconospdf/whatsapp.png')}}" class="icon" alt=""> {{$clinica->celular}}</span>@endif</strong></p>
                    <p class="doctor">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</p>
                </div>
            </header>
            <main>
                <div class="procedimiento">
                    <p class="titulo"><u>Reporte de {{$tipo->procedimiento_nombre }}</u></p>
                    <p class="titulo"></span><strong>PACIENTE: </strong>{{$pacientes->nombre.' '.$pacientes->apellidos}}<span ><strong class="sexo">SEXO:</strong> @if($pacientes->sexo=='M')Masculino @else Femenino @endif</span><span><strong class="edad">EDAD:</strong> {{$edad}} años</span></p>
                </div>
                <div class="contenido" style="font-size:13px">
                    <p>{!!$procedimiento->contenido!!}</p>
                </div>
                <div class="images">
                    <div class="imagen">
                            @isset($img[0]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" class="imgs" alt=""> @endisset
                    </div>
                    <p class="desc">@isset($des[0])<p class="desc">{{ $des[0] }}</p></td> @endisset</p>
                    <div class="imagen">
                            @isset($img[1]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" class="imgs" alt=""> @endisset
                    </div>
                    <p class="desc">@isset($des[1])<p class="desc">{{ $des[1] }}</p></td> @endisset</p>
                    <div class="imagen">
                            @isset($img[2]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" class="imgs" alt=""> @endisset
                    </div>
                    <p class="desc">@isset($des[2])<p class="desc">{{ $des[2] }}</p></td> @endisset</p>
                    <div class="imagen">
                            @isset($img[3]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" class="imgs" alt=""> @endisset
                    </div>
                    <p class="desc">@isset($des[3])<p class="desc">{{ $des[3] }}</p></td> @endisset</p>
                </div>
            </main>
            <footer>
                <div class="firma">
                    <p class="titulo">____________________</p>
                    <p class="titulo">FIRMA Y SELLO</p>
                </div>
                <p class="siimed">SISTEMAS DE INTEGRACION MEDICA <span style="color:#4B4DC5">SIMED</span></p>
            </footer>
</body>
</html>