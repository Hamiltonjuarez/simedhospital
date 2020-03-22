<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            margin-bottom: 10px;
            margin-left: 20px;
            margin-right: 20px;
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
        .page-break{
            page-break-before: always;
        }
        .header{
            text-align: center;
        }   
        
        .data td{
            height: 25px;
        }
        .data span{
            font-weight: normal;
            /* border: 1px solid rgb(200, 150, 0); */
            padding-left: 2px;
            padding-right: 5px;
        }

        .imagenes{
            text-align: center;
        }
        .descripcion{
            /* border: 1px solid rgb(200, 150, 0); */
            padding: 5px;
            font-size: 14px;
        }

        .firma{
            text-align: center;
            position: absolute;
            top: 945px;
        }
        .main{
            width: 100%;
            height: 99%;
            border: 1px solid black;
            position: absolute;
        }
    </style>
</head>
<body>
    
        <table class="header">
                <tr>
                    <td> <img src="{{public_path($doctor->logo)}}" width="100" alt=""> </td>
                </tr>
                <tr>
                    <td width="496">
                        <h3>6 Av. 3-22 Zona 10, Edificio Centro Médico II </h3>
                        <h3>Tel.: 2331-3198 2331-3199</h3>
                    </td>
                </tr>
            </table>
            <table class="header">
                <tr>
                    <td width="496">
                        <h1>Informe de {{ $tipo->procedimiento_nombre }}</h1>
                    </td>
                </tr>
            </table>
        
            {{-- 536 without border (530.1) (527.2) (524.3) (515.4) (521.5) 3px eachborder --}} 
            <table class="data">
                <tr>
                    <td width="248">
                        <b>Fecha:</b>  {{ $fecha['fecha'] }} 
                    </td>
                    <td width="248" colspan="2">
                        <b>{{ $tipo->procedimiento_nombre }} Número:</b> 125
                    </td>
                </tr>
                <tr>
                    <td width="248">
                        <b>Paciente:</b> {{ $pacientes->nombre.' '.$pacientes->apellidos }}
                    </td>
                    <td width="124">
                        <b>Edad:</b> {{ $edad }}
                    </td>
                    <td width="124">
                        <b>Sexo:</b> {{ $pacientes->sexo }}
                    </td>
                </tr>
            </table>
        
            <table class="data">
                <tr>
                    <td width="268">
                        <b>Medico Referente: </b> Dr. Rudy
                    </td>
                </tr>
                <tr>
                    <td width="268">
                        <b>Sedación Asistida por: </b> Dra. Reyes
                    </td>
                </tr>
                
            </table>


            <table>
                
            </table>

            <table width="525">
                <tr>
                    <td>
                        <h4>Hallazgos:</h4>
                    </td>
                </tr>
                <tr>
                    <td class="descripcion">
                            <p>Hasta el ciego. Se identificó la valvula ileocecal.</p>
                            <p>A nivel del colon ascendente con polipo hiperplásico de 0.2cm de aspecto hiperplásico, resecado. El resto
                                    del colon trasverso, y descendente es normal. El colon sigmoides con múltiples diverticulos, uno con lesion
                                    eritematosa en su superficie y halo de material purulento en su periferie, tomé biopsias de esta lesion. A lo
                                    largo de todo el colon con espasmos leves.</p>
                    </td>
                </tr>
            </table>
            
                
            <table width="525">
                <tr>
                    <td>
                        <h4>Diagnostico:</h4>
                    </td>
                </tr>
                <tr>
                    <td class="descripcion">
                            <p>Hasta el ciego. Se identificó la valvula ileocecal.</p>
                            <p>A nivel del colon ascendente con polipo hiperplásico de 0.2cm de aspecto hiperplásico, resecado. El resto
                                    del colon trasverso, y descendente es normal. El colon sigmoides con múltiples diverticulos, uno con lesion
                                    eritematosa en su superficie y halo de material purulento en su periferie, tomé biopsias de esta lesion. A lo
                                    largo de todo el colon con espasmos leves.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Observaciones:</h4>
                    </td>
                </tr>
                <tr>
                    <td class="descripcion">
                        <p>1. Diverticulosis y diverticulitis en sigmoides</p>
                        <p>2. Polipo hiprplásico en colon ascendente resecado.</p>
                        <p>3. Colon espasmodico</p>
                        <p>4. Ano con hemorroides y fisuras crónicas.</p>
                    </td>
                </tr>
            </table>

    <div class="page-break"></div>
    

    <table class="imagenes">
            <tr>
                <td colspan="3">
                    Imágenes de la Endoscopía:
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{asset('capturas/endoscopia/1')}}/2.png" width="215" height="160" alt="">
                </td>
                <td width="12">&nbsp;</td>
                <td><img src="{{asset('capturas/endoscopia/1')}}/2.png" width="215" height="160" alt="">
                </td>
                <td width="12">&nbsp;</td>
                <td><img src="{{asset('capturas/endoscopia/1')}}/3.jpg" width="215" height="160" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{asset('capturas/endoscopia/1')}}/4.jpg" width="215" height="160" alt="">
                </td>
                <td width="12">&nbsp;</td>
                <td>
                    <img src="{{asset('capturas/endoscopia/1')}}/5.png" width="215" height="160" alt="">
                </td>
                <td width="12">&nbsp;</td>
                <td>
                    <img src="{{asset('capturas/endoscopia/1')}}/6.jpg" width="215" height="160" alt="">
                </td>
            </tr>
        </table>

        <div class="firma">
                <h3>Firma: _______________________________</h3>
                <h4>  {{ Auth::user()->name }}</h4>
        </div>
</body>
</html>