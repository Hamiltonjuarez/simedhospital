<!DOCTYPE html>
<html lang="en">
<head>       
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path("assets/dist/css/adminlte.min.css")}}">
    <title>Venta Medicamentos</title>
    <style>
        body{
            padding: 0.5cm;
        }
        .header-left{
            position: fixed;
            top: 0%;
            left: 0%;
            width: 5cm;            
            height: 3cm;
          
        }
        .header-center{
            position: fixed;
            top: 0%;
            left: 6cm;
            width: 7.5cm;           
            text-align: center;
        }
        .header-right{
            position: fixed;
            top: 0%;
            left: 14.5cm;
            width: 4cm;
            height: 0.7cm;
            border: solid 1px black;
            text-align: center;
        }
        .borde{
            position: fixed;
            top: 2.5%;
            left: 14.5cm;
            width: 4cm;
            height: 0.8cm;
            border: solid 1px black;
            text-align: center;
        }
        .fecha{
            position: fixed;
            top: 0.5%;
            left: 14.5cm;
            width: 4cm;               
            text-align: center;
        }
        .fechanum{
            position: fixed;
            top: 2.9%;
            left: 14.5cm;
            width: 4cm;               
            text-align: center;
        }
        .pacienteborder{
            position: fixed;
            top: 13.6%;
            left: 0cm;
            width: 18cm ;
            height: 1.3cm;
            border: solid 1px black;
            padding: 10px;
        }
        .items{
            position: fixed;
            top: 23.9%;
            left: 0cm;
            width: 18.7cm ;
            text-align: center;            
        }
       
       table{
           text-align: center;
       }
       .footer{
            position: fixed;
            top: 87.7%;
            left: 0cm;
            width: 10.2cm ;
           
       }
       .footer1{
            position: fixed;
            top: 87.7%;
            left: 11cm;
            width: 7.2cm ;
            
       }
       .total{
           color: crimson;
       }
       
    </style>
</head>
<body>
    <div class="header-left">
    <img src="{{public_path('/adjuntosdoctor/'.$doc->id.'-'.$doc->apellidosDoctor.'/logo.png')}}" width="100%" height="100%" alt="">
    </div>
    <div class="header-center">
    <h3>{{$clinica->direccion}}</h3>
    </div>
    <div class="header-right">
       
    </div>
    <div class="borde">

        </div>
        <div class="fecha">
            FECHA
        </div>
        <div class="fechanum">
           <h4> {{Carbon\Carbon::now()->format('d')}}/{{Carbon\Carbon::now()->format('m')}}/{{Carbon\Carbon::now()->format('Y')}}</h4>
        </div>
        <div class="pacienteborder">
        <b>Paciente: </b> @if(@isset($paciente->nombre))<u>{{$paciente->nombre." ".$paciente->apellidos}}</u> <br>
        <b>Telefonos: </b> <u>{{$paciente->telefono}}</u>@else <u>{{$paciente}}</u>@endif
        </div> 
        <div class="items">       
            <table class="a table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Medicamento</th>
                        <th scope="col">Precio por unidad</th>                          
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicamentos as $medicamento)
                        <tr>
                            <th>{{$medicamento->cantidad}}</th>
                            <th>{{$medicamento->nombre}}</th>
                            <th>{{"$"." ".$medicamento->precio}}</th>
                        </tr>
                    @endforeach
                        <tr>                            
                            <th class="total" colspan="2">Total de venta: </th>
                            <th class="total">{{"$"." ".$total}}</th>
                        </tr>
                </tbody>
           </table>              
        </div>
        <div class="footer">
            <b>Correo Electronico:</b> {{$clinica->email}} <br>
            <b>Telefonos:</b> {{$clinica->telefonos}}
        </div>
        <div class="footer1">
                <b>Pagina Web:</b> {{$clinica->paginaWeb}} <br>
                <b>Facebook:</b> {{$clinica->facebook}}
            </div>
</html>