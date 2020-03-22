@extends('procedimientos.layouts.singlepage')
@section('titulo')
    {{$pacientes->apellidos.', '.$pacientes->nombre}}
@endsection
@section('styles')
    <style>
        footer{
            border:none;
        }
    </style>
@endsection

@section('content-header')
<table class=" text-right">
    <tr>
        <td width="45%">
            <img src="{{public_path($doctor->logo)}}" width="100%" height="150px" alt="">
        </td>
        <td class="align-top p-1" >
            <p class="pequenio text-capitalize" >{{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</p>
            <h4 class="text-danger text-capitalize" style="margin:0%">Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</h4>
            @isset($especialidad->specialty_name)<h5  style="margin:0%">{{$especialidad->specialty_name}}</h5>@endisset
        </td>
    </tr>
</table>
@endsection
@section('content-main')
    <table class="table-bordered text-center">
        <tr>
            <td colspan="3">
                <h4 class="font-weight-bold">Reporte de {{$tipo->procedimiento_nombre }}</h4>
            </td>
        </tr>
        <tr>
            <td class="text-left text-capitalize"><b>Paciente: </b>{{$pacientes->apellidos.', '.$pacientes->nombre}}</td>
            <td width="15%"><b>Sexo: </b>{{$pacientes->sexo}}</td>
            <td width="15%"><b>Edad: </b>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="pequenio align-top">
                <br>
                {!!$procedimiento->contenido!!}
            </td>
            <td width="40%" class="text-center">
                @isset($img[0]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="100%" height="175px" style="border-radius:5px" alt=""> @endisset @isset($des[0]) <p class="pequenio"> {{ $des[0] }} </p> @endisset
                @isset($img[1]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="100%" height="175px" style="border-radius:5px" alt=""> @endisset @isset($des[1]) <p class="pequenio"> {{ $des[1] }} </p> @endisset
                @isset($img[2]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="175px" style="border-radius:5px" alt=""> @endisset @isset($des[2]) <p class="pequenio"> {{ $des[2] }} </p> @endisset
                @isset($img[3]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="175px" style="border-radius:5px" alt=""> @endisset @isset($des[3]) <p class="pequenio"> {{ $des[3] }} </p> @endisset
            </td>
        </tr>
    </table>
@endsection
@section('content-footer')
    <table class="mt-3">
        <tr>
            <td class="text-secondary">
                <p class="pequenio text-left">_____________________</p>
                <p class="pequenio text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMA Y SELLO</p>
                <p class=" text-center text-primary mt-1" style="font-size:11px">{{$clinica->direccion}} || {{$clinica->telefonos}} || {{$clinica->celular}} </p>
            </td>
        </tr>
    </table>
@endsection