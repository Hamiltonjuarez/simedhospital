@extends('procedimientos.layouts.singlepage')
@section('titulo')
    {{$pacientes->apellidos.', '.$pacientes->nombre}}
@endsection
@section('content-header')
    <table class="mt-2">
        <tr>
            <td width="30%">
                {{-- <img src="{{public_path('procedimientos/plantilla/zablah/logov.png')}}" width="100%" height="175px" alt=""> --}}
                <img src="{{public_path($doctor->logo)}}" width="100%" height="150px" alt="">
            </td>
            <td class="align-top text-center">
                <h4 class="text-danger font-weight-bold" style="font-family:fantasy;margin:0%"><u>Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</u></h4>
                <p class="text-danger font-weight-bold" style="font-family:fantasy;margin:0%">Pediatra Gastroenterólogo</p>
                {{-- @isset($especialidad->specialty_name)<h5  style="margin:0%">{{$especialidad->specialty_name}}</h5>@endisset --}}
                <p class="pequenio">{{$clinica->direccion}}</p>
                <p class="pequenio"><b>Teléfono: </b>{{$clinica->telefonos}} <b>Celular: </b>{{$clinica->celular}} </p>
                <p class="pequenio"><b>E-mail: </b>{{$clinica->email}}</p>
            </td>
            @if(Auth::user()->id == 2)
            <td width="10%">
                <img src="{{ public_path('procedimientos/plantilla/zablah/multipediatrica.jpg')}}" width="100%" height="auto" alt="">
            </td>
            @endif
        </tr>
    </table>
@endsection
@section('content-main')
    <table style="border:black 1px solid;font-family:fantasy">
        <tr>
            <td><p class="p-1"><b>Procedimiento: </b>{{$tipo->procedimiento_nombre }}</p></td>
            <td colspan="2"><p class="text-left text-capitalize p-1" ><b>Fecha: </b>{{ \Carbon\Carbon::parse($historial->created_at)->format('d/m/Y')}}</p></td>
        </tr>
        <tr>
            <td class="text-left text-capitalize p-1"><b>Paciente: </b>{{$pacientes->apellidos.', '.$pacientes->nombre}}</td>
            <td width="15%">&nbsp;<b>Sexo: </b>{{$pacientes->sexo}}</td>
            <td width="15%"><b>Edad: </b>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}}</td>
        </tr>
    </table>
    <table class="text-center mt-1" style="border:black 1px solid;font-family:fantasy">
        <tr>
            @isset($img[0])<td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="100%" height="175px" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[0] }} </p></td> @endisset
            @isset($img[1])<td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="100%" height="175px" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[1] }} </p></td> @endisset
            @isset($img[2])<td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="175px" style="border-radius:5px" alt=""> <p class="pequenio"> {{ $des[2] }} </p></td> @endisset
        </tr>
    </table>
    <table class="text-center" style="border:black 1px solid;font-family:fantasy">
        <tr>
            @isset($img[3])<td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="100%" height="175px" style="border-radius:5px" alt="">  <p class="pequenio"> {{ $des[3] }} </p></td> @endisset
            @isset($img[4])<td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" width="100%" height="175px" style="border-radius:5px" alt="">  <p class="pequenio"> {{ $des[4] }} </p></td> @endisset
            @isset($img[5])<td> <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" width="100%" height="175px" style="border-radius:5px" alt="">  <p class="pequenio"> {{ $des[5] }} </p></td> @endisset
        </tr>
    </table>
    <table class="pequenio mt-1" style="border:black 1px solid;font-family:fantasy">
        <tr>
            <td class="p-1">{!!$procedimiento->contenido!!}</td>
        </tr>
    </table>
@endsection
@section('content-footer')
<table class="text-center text-secondary pequenio mt-4">
    <tr>
        <td>
            <p>____________________</p>
            <p>FIRMA Y SELLO</p>
        </td>
    </tr>
</table>
<p class="pequenio text-right">Sistemas de Integración Médica <b class="text-primary">SIMED</b></p>
@endsection