<!DOCTYPE html>
<html lang="en">
  
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pacientes->nombre.' '.$pacientes->apellidos}}</title>
   
    <style>
       
    @import url('https://fonts.googleapis.com/css?family=Nova+Round&display=swap');

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
            font-family: 'Nova Round', ;
        }
        .fecha{
            float: right;
            font-style: italic;
        }
        footer{
            
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
           
        }
        .desc2{
         /*    height: 60px;
            border: solid black 1px; */
            color: white;
        }
        .imagenes{
            position: fixed;
            top: 6.0cm;
            left: 1.1cm;
           /*  border-top: solid 1px black;
            border-bottom: solid 1px black; */
            width: 19.3cm;
        }
        .bordertotal{
            border: 2px solid #309CE1;
            border-radius: 10px;
            padding: 0.0cm;
            position: fixed;
            top: 1.5cm;
            left: 1cm;
            right: 1cm;
            bottom: 1.3cm;
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
        .logo{
            position: fixed;
            height: 3cm;
            width: 51%;
          /*   border: 1px solid #000; */
            top: 1.6cm;
            left: 1.1cm;
            border-radius:10px;
        }
        .doctor{
            position: fixed;
            height: 4cm;
            width: 50%;
            /* border: 1px solid #000; */
            top: 2.0cm;
            left: 10.5cm;
            border-radius:10px;
            font-size: 20px;
        }
        .d1{
            position: fixed;
            top: 1.9cm;
            left: 11.4cm;
            font-size:28px;
            font-family: 'Nova Round', ;
        }
        .d2{
            position: fixed;
            top: 1.9cm;
            left: 12.4cm;
           /*  color: #7029CB; */
            font-size:28px;
            font-family: 'Nova Round', ;
        }
        .d3{
            position: fixed;
            top: 1.9cm;
            left: 15cm;
           /*  color: #25D00A; */
            font-size:28px;
            font-family: 'Nova Round', ;
        }
        .d4{
            position: fixed;
            top: 1.9cm;
            left: 16.6cm;
            /* color: #7029CB; */
            font-size:28px;
            font-family: 'Nova Round', ;
        }
        .d5{
            position: fixed;
            top: 1.9cm;
            left: 19.4cm;
            /* color: #25D00A; */
            font-size:28px;
            font-family: 'Nova Round', ;
         
        }
        .leyenda{
            position: fixed;
            height: 4cm;
            width: 40%;
           /*  border: 1px solid #000; */
            top: 3.0cm;
            left: 12.2cm;
            border-radius:10px;
            font-size: 14px;
        }
        .foot{
            position: fixed;
            top: 25cm;
            left: 1.5cm;
            width: 90%
        }
    </style>
</head>
<body>
  <div class="bordertotal">
    <div class="logo">
        <img src="{{public_path()}}/img/logo.png" width="100%" height="130px" alt="">
    </div>
    <div class="doctor">
        <p class="d1">Dr.</p><p class="d2">Miguel</p><p class="d3">Elías</p> <p class="d4">Escobar</p><p class="d5"> M.</p>
    </div>
    <div class="leyenda">
        <p> &nbsp;  &nbsp;GASTROCIRUGIA GASTROENTEROLOGIA ENDOSCOPIA DIGESTIVA INTERVENCIONISTA          
        </p>
    </div>
    <div class="imagenes">
        <table style="padding-left:12px">
            <tr>    
                @isset($img[0])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" height="200px" width="230" alt="">@if(!empty($des[0]))<p class="desc">{{ $des[0] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
                @isset($img[1])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" height="200px" width="230" alt="">@if(!empty($des[1]))<p class="desc">{{ $des[1] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
                @isset($img[2])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" height="200px" width="230" alt="">@if(!empty($des[2]))<p class="desc">{{ $des[2] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
            </tr>
            <tr>
                @isset($img[3])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" height="200px" width="230" alt="">@if(!empty($des[3]))<p class="desc">{{$des[3] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
                @isset($img[4])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" height="200px" width="230" alt="">@if(!empty($des[4]))<p class="desc">{{$des[4] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
                @isset($img[5])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" height="200px" width="230" alt="">@if(!empty($des[5]))<p class="desc">{{ $des[5] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
            </tr>
            <tr>
                @isset($img[6])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[6]}}" height="200px" width="230" alt="">@if(!empty($des[5]))<p class="desc">{{ $des[5] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
                @isset($img[7])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[7]}}" height="200px" width="230" alt="">@if(!empty($des[7]))<p class="desc">{{ $des[6] }}</p>@else <p class="desc2">a</p> @endif</td>@endisset
                @isset($img[8])<td><img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[8]}}" height="200px" width="230" alt="">@if(!empty($des[8]))<p class="desc">{{ $des[7] }}</p>@else <p class="desc2">c</p> @endif</td>@endisset
            </tr>
        </table>
    </div>
    <div class="foot">
        <p>Edif. Centro de Diagnóstico, 2a. Planta, Clinica No.29 Col. Medica, Tel.: 2502-5156  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Cel.: 7170-5394
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E-mail: endodiagnostica.es@gmail.com
        </p>
    </div>
  </div>
    <footer>
       {{--  <div class="redes">
            @if($clinica->email!=null) <span><img src="{{public_path('iconospdf/email.png')}}" class="icon" alt=""> {{$clinica->email}}</span>@endif 
            @if($clinica->paginaWeb!=null) <span><img src="{{public_path('iconospdf/web.png')}}" class="icon" alt=""> {{$clinica->paginaWeb}}</span>@endif
            @if($clinica->facebook!=null) <span><img src="{{public_path('iconospdf/facebook.png')}}" class="icon" alt=""> {{$clinica->facebook}}</span>@endif 
            @if($clinica->instagram!=null) <span><img src="{{public_path('iconospdf/instagram.png')}}" class="icon" alt=""> {{$clinica->instagram}}</span>@endif
        </div> --}}
        <p class="siimed">SISTEMAS DE INTEGRACION MEDICA <span style="color:#4B4DC5">SIIMED</span></p>
    </footer>
</body>
</html>