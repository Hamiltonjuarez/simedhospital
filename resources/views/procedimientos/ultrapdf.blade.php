<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pacientes->nombre }} - Ultrasonido</title>
    <style>
        .body{
            margin-top: 15px;
        }
        .titulo{
            text-align: center;
            font-size: 12px;
        }
        .titulo label{
            font-weight: bold;
            font-size: 22px;
        }
        .info{
            vertical-align: top;
        }
        .info label{
            font-size: 18px;
            font-weight: bold;
        }
        .img label{
            font-size: 13px;
        }
        .img img{
            width: 250px;
            max-height: 200px;
        }
        .line{
            border: solid 2px blue;
            height: 1px:

        }

    </style>
</head>
<body>
    <div>
        <table >
                <thead>
                    <tr>
                        <td width="60">
                            <img src="{{asset('assets/dist/img/siimed.png')}}" alt="" height="60">
                        </td>
                        <td width="390" class="titulo">
                            <label for="">{{$users->name}}</label><br>
                            Médico Especialista en Ginecologia y Obstetrica <br>
                            Coloscopista por el instituto Ficticio de Coloscopiastas <br>
                        </td>
                        <td width="60">

                        </td>
                    </tr>
                </thead>
        </table>
    </div>
    <div class="line"></div>
    <div>
        <table class="body">
                <tbody>
                    <tr>
                        <td width="310" class="info">
                                <label for="">Reporte de Ultrasonido</label> <br><br>
                                Fecha: {{$fecha['fecha']}} <br>
                                Paciente: {{$pacientes->nombre.' '.$pacientes->apellidos}}<br>
                                Edad: {{$edad}} años <br>

                                {!! $reportes->hallazgos !!}
                        </td>
                        <td width="10"></td>
                        <td width="190" class="img">
                            <img src="{{asset('assets/img/ultra/1/img1.jpg')}}" alt=""><br>
                            <label>fig1. probando la magia de esta casilla que no se pude ver ni tocar</label> <br>
                            <img src="{{asset('assets/img/ultra/1/img2.jpg')}}" alt=""><br>
                            <label>fig2. probando la magia de esta casilla que no se pude ver ni tocar</label> <br>
                            <img src="{{asset('assets/img/ultra/1/img2.jpg')}}" alt=""><br>
                            <label>fig3. probando la magia de esta casilla que no se pude ver ni tocar</label> <br>
                            <img src="{{asset('assets/img/ultra/1/img2.jpg')}}" alt=""><br>
                            <label>fig4. probando la magia de esta casilla que no se pude ver ni tocar</label> <br>

                            {{-- img 1
                            <img src="{{asset('assets/img/ultra/1/img3.jpg')}}" width="175" alt=""> <br>
                            img 1 <br><br><br>
                            <img src="{{asset('assets/img/ultra/1/img4.jpg')}}" width="175" alt=""> <br>
                            img 1 <br><br><br> --}}
                        </td>
                    </tr>
                </tbody>
        </table>
    </div>



</body>
</html>
