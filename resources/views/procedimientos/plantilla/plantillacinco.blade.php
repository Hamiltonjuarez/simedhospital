@extends('procedimientos.layouts.doublepage')

@section('titulo')
    {{$pacientes->nombre.', '.$pacientes->apellidos}}
@endsection
@section('styles')
    <style>
        footer{
            border:none;
        }
    </style>
@endsection

@section('content-header')
    <table class=" mt-4 ">
        <tr>
            <td width="45%">
                <img src="{{ public_path($doctor->logo) }}" width="100%" height="auto" alt="{{$clinica->nombreClinica}}">
            </td>
            <td class="align-top p-2">
                <p class="pequenio text-right text-capitalize">{{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</p>
                <h4 class="text-capitalize text-center">Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</h4>
                <h3 class="text-uppercase text-center font-weight-bold mt-4" style="font-size:14px"><u>Reporte de {{$tipo->procedimiento_nombre }}</u></h3>
            </td>
        </tr>
    </table>
@endsection

@section('content-main')
    <div class="container mt-4" >
        <div class="row">
            <div class="col-xs-12">
                <table class="table-bordered">
                    <tr class="text-center">
                        <td class="text-left"><b>Paciente: </b>{{$pacientes->apellidos.' '.$pacientes->nombre}}</td>
                        <td width="15%"><b>Sexo: </b>{{$pacientes->sexo}}</td>
                        <td width="15%"><b>Edad: </b>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}}</td>
                    </tr>
                </table>
                <table  class=" pequenio mt-4">
                    <tr >
                        <td colspan="3" class="align-top" style="height:70%">
                                {!!$procedimiento->contenido!!}
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <p class="pquenio text-center  text-secondary">
                                ________________
                            </p>
                            <p class="pequenio text-center  text-secondary mb-4">FIRMA Y SELLO</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <p class="pequenio text-right mr-4">Sistemas de Integración médica <b class="text-primary">SIMED</b></p>
@endsection
<img src="{{ public_path($doctor->marca) }}" class="marcadeagua" alt="{{$clinica->nombreClinica}}">
@section('content-footer')
<table>
    <tr>
        <td><hr style="height:3px;" class="bg-danger"></td>
        <td><hr style="height:3px;" class="bg-primary"></td>
        <td><hr style="height:3px;" class="bg-success"></td>
        <td><hr style="height:3px;" class="bg-warning"></td>
    </tr>
</table>
<table class="pequenio align-top">
    <tr class="text-center">
        @isset($clinica->telefonos)<td><p><img src="{{public_path('iconospdf/telefono.png')}}" class="icono" alt=""> {{$clinica->telefonos}}</p></td>@endisset
        @isset($clinica->instagram)<td colspan="2"> <p style="margin-top:1px"><img src="{{public_path('iconospdf/instagram.png')}}" class="icono" alt=""> {{$clinica->instagram}}</p></td>@endisset
        @isset($clinica->celular)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/whatsapp.png')}}" class="icono" alt=""> {{$clinica->celular}}</p></td>@endisset
        @isset($clinica->paginaWeb)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/web.png')}}" class="icono" alt=""> {{$clinica->paginaWeb}}</p></td>@endisset
    </tr>
    <tr class="text-center">
        @isset($clinica->email)<td colspan="2" > <p style="margin-top:1px"><img src="{{public_path('iconospdf/email.png')}}" class="icono" alt=""> {{$clinica->email}}</p></td>@endisset
         @isset($clinica->facebook)<td colspan="2"> <p style="margin-top:1px"><img src="{{public_path('iconospdf/facebook.png')}}" class="icono" alt=""> {{$clinica->facebook}}</p> </td>@endisset
    </tr>
    <tr class="text-center">
        <td colspan="4"><p><img src="{{public_path('iconospdf/direccion.png')}}" class="icono" alt="">{{$clinica->direccion}}</p></td>
    </tr>
</table>
@endsection

@section('content-imagenes')
<table class=" text-center mt-2">
    <tr>
        <td > <p class="pequenio text-right text-capitalize">{{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</p></td>
    </tr>
    <tr>
        <td><img src="{{ public_path($doctor->logo)}}" width="400px" height="auto" alt="Logo"></td>
    </tr>
</table>
<table class="table-bordered text-center">
    <tr>
        <td colspan="3">
            <h4 class="text-uppercase">Reporte fotográfico de {{$tipo->procedimiento_nombre}}</h4>
        </td>
    </tr>
    <tr>
        <td width="70%" class="text-left"><p class="pequenio"><b>Paciente: </b>{{$pacientes->nombre.' '.$pacientes->apellidos}}</p></td>
        <td><p class="pequenio"><b>Sexo: </b>{{$pacientes->sexo}}</p></td>
        <td><p class="pequenio"><b>Edad: </b>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}}</p></td>
    </tr>
</table>
<table class="text-center mt-4">
    <tr>
        @isset($img[0])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[0] }} </p> </td>@endisset
        @isset($img[1])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[1] }} </p> </td>@endisset
        @isset($img[2])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="auto" style="border-radius:5px" alt="">  <p class="pequenio"> {{ $des[2] }} </p> </td>@endisset
    </tr>
</table>
<table class="text-center">
    <tr>
        @isset($img[3])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[3] }} </p> </td> @endisset
        @isset($img[4])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[4] }} </p> </td> @endisset
        @isset($img[5])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[5] }} </p> </td> @endisset
    </tr>
</table>
<table class="text-center">
    <tr>
        @isset($img[6])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[6]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[6] }} </p> </td> @endisset
        @isset($img[7])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[7]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[7] }} </p> </td> @endisset
        @isset($img[8])<td class="align-top"> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[8]}}" width="100%" height="auto" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[8] }} </p> </td> @endisset
    </tr>
</table>
@endsection