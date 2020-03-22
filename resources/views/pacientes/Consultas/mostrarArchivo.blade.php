<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$paciente->Apellidos, $paciente->nombre}}</title>
        <link rel="stylesheet" href="{{public_path('css/css_reportes/bootstrap.css')}}">
        <style>
            @page{
                margin: 0%;
                padding: 0%;
            }
            header{
                margin: 0%;
                padding: 0%;
            }
            main{
                margin: 0%;
                padding: 0%;
            }
            footer{
                position: fixed;
                bottom: 0%;
                height: 2cm;
            }
            table{
                width: 100%;
                margin: 0%;
                padding: 0%;
                table-layout: fixed;
            }
            .text-sm{
                font-size:12px;
            }
            .text-md{
                font-size:14px;
            }
            p{
                margin: 0%;
                padding: 0%;
            }
        </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <table class="mt-4">
                        <tr>
                            <td class="align-top">
                                <p class="text-md mt-4"><strong>Fecha: </strong>{{\Carbon\Carbon::parse($adjunto->created_at)->locale('es_Es')->isoFormat('dddd, LL')}}</p>
                                <p class="text-md"><strong>Doctor: </strong>{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} @if($doctor->codigoDoctor != null) | <strong>J.V.P.M. </strong>{{$doctor->codigoDoctor}} @endif</p>
                                <p class="text-md"><strong>Paciente: </strong>{{$paciente->nombre.' '.$paciente->apellidos}}</p>
                            </td>
                            <td width="30%">
                                <img src="{{asset($doctor->logo)}}"  width="100%" height="130px" alt="Logo">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <table>
                       @if($adjunto->descripcion != null)
                       <tr>
                            <td class="text-sm"><strong class="text-md">Descripción: </strong>{{$adjunto->descripcion}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>
                                <img src="{{public_path($adjunto->adjunto)}}" width="100%" height="600px" alt="adjunto">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <table class="text-center">
                        <tr>
                            <td>
                                <p class="text-md font-weight-bold">F____________________________</p>
                                <p class="text-md font-weight-bold">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} @if($doctor->codigoDoctor != null) | <strong>J.V.P.M. </strong>{{$doctor->codigoDoctor}} @endif</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
