@extends('Recetas.layouts.templateuno')

@section('title')
   @isset($paciente)
   {{$paciente->apellidos.', '.$paciente->nombre}}
   @endisset
@endsection

@section('content-header')
    <table>
        <tr>
            <td width="50%">
                <img src="{{public_path($doctor->logo)}}" width="100%" height="auto" alt="{{$clinica->nombreClinica}}">
            </td>
            <td style="border-left:#007bff solid 2px" class="align-top text-small">
                <table style="margin:10px">
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/clinica.png') }}" width="100%" height="auto" alt=""></td>
                        <td class="pl-1">{{$clinica->nombreClinica}}</td>
                    </tr>
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/ubicacion.png') }}" width="100%" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->direccion}}</td>
                    </tr>
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/tel.jpg') }}" width="100%" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->telefonos}}</td>
                    </tr>
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/puntero.png') }}" width="100%" class="mt-1" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->paginaWeb}}</td>
                    </tr>
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/email.png') }}" width="100%" class="mt-1" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->email}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection

@section('content-main')
<img src="{{public_path($doctor->marca)}}" class="marca" alt="">
<table class="mt-4">
    <tr>
        <td width="10%" class="text-left pr-2 font-weight-bold"><span>Fecha:</span></td>
        <td class="text-capitalize text-center" style="border-bottom:black solid 1px">{{ \Carbon\Carbon::parse(now())->locale('es_Es')->isoFormat('dddd, LL') }}</td>
    </tr>
</table>
<table class="mt-2">
    @isset($paciente)
    <tr>
        <td width="10%" class="font-weight-bold pr-2 text-left">Paciente:</td>
        <td class="text-capitalize text-center" style="border-bottom:black solid 1px">{{$paciente->apellidos.', '.$paciente->nombre}}</td>
    </tr>
    @endisset
</table>
<table class="mt-2">
    <tr>
        <td width="10%" class="font-weight-bold pr-2 text-left">Doctor:</td>
        <td class="text-capitalize text-center" style="border-bottom:black solid 1px">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</td>
    </tr>
</table>

<table class="mt-4 ">
    <tr >
        <td class="align-top" height="75%">
           <h4>Rx.</h4> {!! $receta->descripcionReceta !!}
        </td>
    </tr>
</table>
@endsection
@section('content-footer')
    <table class="mt-5">
        <tr>
            <td><hr class="bg-primary" style="height:5px"></td>
            <td><hr style="background-color:blueviolet; height:5px"></td>
            <td><hr style="background-color:chartreuse; height:5px"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-right text-small">Sistemas de Integración Médica <b class="text-primary">SIMED</b></td>
        </tr>
    </table>
@endsection