 <!DOCTYPE html>
 <html lang="en">
 <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
     
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>{{$paciente->nombre.' '.$paciente->apellidos}}</title>
     <style>
         @page{
             margin: 0;
             padding: 0;
         },
         header{
             padding: 0.5cm;
             height: 4cm;
             border-bottom: 1px solid #000;
         },
         .logo{
             width: 100%;
             max-height: 300px;
         }
         main{
             margin: 0.2cm 0.5cm 0.5cm 0.7cm;
             border: #000 solid 1px;
             padding: 0.1cm;
             height: 20cm;
         },
         footer{
             border-top:#000 solid 1px;
             position:  fixed;
             bottom: 0%;
             height: 2cm;
             padding: 0.7cm;
         }

     </style>
 </head>
 <body>
     <header>
        <table id="encabezado" style="width:100%;">
            <tr>
                <td style="vertical-align:top;">
                    <span style="text-transform:capitalize;font-size:12px">
                        <b>Fecha: </b>{{ \Carbon\Carbon::parse($consulta->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}
                    </span>
                    <p style="margin-top:5px;margin-bottom:0px;font-size:18px"><b>Doctor:</b> {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</p>
                    @if($doctor->specialty_name)
                    <p style="margin:0px;font-size:14px"><b>Especialidad:</b> {{$doctor->specialty_name}}</p>
                    @endif
                </td>
                <td width="200px;vertical-align:top"><img src="{{public_path('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/'.$doctor->logo)}}" alt="" class="logo"></td>
            </tr>
        </table>
     </header>
     <main>
        <table style="width:100%">
            <tr>
                <td><b>Paciente: </b>{{$paciente->nombre.' '.$paciente->apellidos}}</td>
                <td><b>Sexo: </b>{{$paciente->sexo}}</td>
                <td style="text-align:right"><b>Edad: </b> {{\Carbon\Carbon::parse($paciente->nacimiento)->age}}</td>
            </tr>
        </table>
        <hr>
        <table style="margin:0;padding:0%;margin-top:5px">
            <tr>
                <td style="text-align:center"><h3>{{$consulta->tituloConsulta}}</h3></td>
            </tr>
            <tr>
                <td>
                    <h4 style="margin:0">Detalle:</h4>
                    <p style="margin:1%;text-align:justify;margin:0">{!!$consulta->detalleConsulta!!}</p><br>
                </td>
            </tr>
            @if($consulta->diagnostico)
            <tr>
                <td>
                    <h4 style="margin:0">Diagnóstico</h4>
                    <p style="margin:1%;text-align:justify;margin:0">{!!$consulta->diagnostico!!}</p><br>
                </td>
            </tr>
            @endif
            @if($consulta->prescripcion)
            <tr>
                <td>
                    <h4 style="margin:0">Prescripción</h4>
                    <p style="margin:1%;text-align:justify;margin:0">{!!$consulta->prescripcion!!}</p>
                </td>
            </tr>
            @endif
        </table>
     </main>
     <footer>
        <table style="width:100%">
            <tr>
               @if($clinica->telefonos)<td style="text-align:center">Tel: {{$clinica->telefonos}}</td>@endif
                @if($clinica->celular)<td tyle="text-align:center">Cel: {{$clinica->celular}}</td>@endif
                @if($clinica->facebook)<td tyle="text-align:center">Facebook: {{$clinica->facebook}}</td>@endif
                @if($clinica->email)<td tyle="text-align:center">Email: {{$clinica->email}}</td>@endif
            </tr>
        </table>
     </footer>
 </body>
 </html>