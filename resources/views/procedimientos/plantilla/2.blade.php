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
        
        .data td{
            font-weight: bold;
        }
        .data span{
            font-weight: normal;
            /* border: 1px solid rgb(200, 150, 0); */
            padding-left: 2px;
            padding-right: 5px;
        }

        .imagenes img{
            
        }

        /* .imagenes div{
            background-color: black;
            color: white;
            text-align: center;
            font-size: 10;
            vertical-align: top;
        } */
        .descripcion{
            /* border: 1px solid rgb(200, 150, 0); */
            padding: 5px;
            font-size: 13px;
        }

        .firma{
            text-align: center;
            position: absolute;
            top: 945px;
        }
        .contenido{
            vertical-align:text-top;
            margin-left: 5px;
        }
        /* .line{
            text-align: center;
            position: absolute;
            top: 970px;
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
        } */
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td width="100"> <img src="{{public_path($doctor->logo)}}" width="100" alt=""> </td>
            <td width="336">
                <h1>{{ $doctor->tituloDoctor }}</h1>
                <h3>{{$doctor->slogan}}</h3>
                <h3>{{$doctor->direccion}}</h3>
                <h3>{{$doctor->telefono}}</h3>
            </td>
            <td width="100"></td>
        </tr>
    </table>

    {{-- 536 without border (530.1) (527.2) (524.3) (515.4) (521.5) 3px eachborder --}} 
    <table class="data">
        <tr>
            <td width="268">
                Fecha: <span> {{ $fecha['fecha'] }} </span>
            </td>
            <td width="268" colspan="2">
                {{ $tipo->procedimiento_nombre }} Número: <span>{{ $procedimiento->id }}</span>
            </td>
        </tr>
        <tr>
            <td width="268">
                Paciente: <span> {{ $pacientes->nombre.' '.$pacientes->apellidos }} </span>
            </td>
            <td width="134">
                Edad: <span> {{ $edad }} </span>
            </td>
            <td width="134">
                Sexo: <span> {{ $pacientes->sexo }} </span>
            </td>
        </tr>
    </table>
    
    <br>


    <table width="545">
        <tr>
            <td width="210" >
                <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="210" height="155" alt=""></p> <p> {{ $des[0] }} </p>
                <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="210" height="155" alt=""></p> <p> {{ $des[1] }}</p>
                <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="210" height="155" alt=""></p> <p> {{ $des[2] }}</p>
                <p><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="210" height="155" alt=""></p> <p> {{ $des[3] }}</p>
                    
            </td>
            <td class="contenido">
                    <table>
                        <tr>
                            <td>
                                {!! $procedimiento->contenido !!}
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
    
    

    
    <div class="firma">
        <h3>Firma: _______________________________</h3>
        <h4>  {{ $doctor->tituloDoctor }}</h4>
    </div>
    {{-- <div class="line">
        <div class="line-left"></div>
        <div class="line-right"></div>
    </div> --}}
</body>
</html>