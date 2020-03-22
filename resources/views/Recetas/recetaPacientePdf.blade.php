<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siimed</title>
<style>
    .header,.footer {width: 100%; height: 100px; text-align: center; position: fixed;}
    .header {top: 0px;}
    .footer {bottom: 0;}
    body{font-family: "Times New Roman", serif; margin: 15mm 8mm 2mm 8mm;},
    .titulo{small-caps 100%/200% serif;text-align:center;font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;},
    table, th, td{width:100%;},
    .infoMedico{text-align: right;},
    .line{border: solid 2px blue; height: 1px; margin-left:50px; margin-right:50px; margin-top:15mm;},
    .consulta{height: 120mm;}

            .descripcion{
                text-align: justify;
            }
hr {
page-break-after: always;
border: 0;
margin: 0;
padding: 0;
}

body{
    border: 1px solid rgb(19, 55, 132  );
    padding: 10px;
}

    </style>
</head>
<body>
    <div class="header">
        <table>
            <thead>
                <tr>
                    <td><h1 class="titulo">RECETA MÉDICA</h1></td>
                </tr>
            </thead>
        </table>
    </div>
            <div>
                    <table class="head">
                            <thead>
                                <tr>
                                        <td width="250px"  class="logo">
                                                <img src="{{ public_path('adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/'.$doctor->logo)}}" alt="" height="150" >
                                        </td>
                                        <td  class="infoMedico">
                                                <strong>FECHA:</strong>  <label for=""> {{ \Carbon\Carbon::parse($receta->created_at)->format('d/m/Y')}}</label><br><br>
                                                <label for="">DR. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</label>
                                                <br>
                                                <label for=""><strong>Especialidad: </strong></label>
                                                <label for="">{{$doctor->specialty_name}}</label><br>
                                        </td>
                                </tr>
                            </thead>
                    </table>
                </div>
                <br>
                <div class="body">
                        <div class="consulta">
                                <table>
                                    <tr>
                                        <td><h3>{{$receta->tituloReceta}}</h3></td>
                                        </tr>
                                        <tr>
                                        <td>{!!$receta->descripcionReceta!!}</td>
                                        </tr>
                                </table>
                            </div>
                            <div>
                                <table class="firmaLogo">
                                    <thead>
                                        <tr>
                                            <td><h4>Firma: _______________________________</h4>
                                                <h5>{{$doctor->tituloDoctor}}</h5>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                </div>

                <div class="footer">
                    <table>
                        <thead>
                            <tr class="fila">
                                <td class="titulo">
                                    {{$doctor->direccion}}
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
</body>
</html>

