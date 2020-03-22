@extends('Recetas.layouts.templateuno')
@section('title')
   @isset($paciente)
   {{$paciente->apellidos.', '.$paciente->nombre}}
   @endisset
@endsection
@section('styles')
    <style>
        .line-top{
            display: none;
        }
        .pequenio{
            font-size:12px;
        }
    </style>
@endsection

@section('content-header')
    <table class="mt-2">
        <tr>
            <td width="50%">
                <img src="{{public_path($doctor->logo)}}" width="100%" height="auto" alt="">
            </td>
            <td class="align-top ">
                <p class="text-capitalize text-right">{{ \Carbon\Carbon::parse(now())->locale('es_Es')->isoFormat('dddd, LL') }}</p>
            </td>
        </tr>
    </table>
@endsection
@section('content-main')
{{-- <img src="{{public_path('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/logo2.png')}}" class="marca" alt=""> --}}
    <table class="table-bordered">
        <tr>
            <td colspan="3" class="text-center"><h4>RECETA MÉDICA</h4></td>
        </tr>
        @isset($paciente)
        <tr>
            <td class="text-capitalize text-left"><strong>Paciente: </strong>{{$paciente->apellidos.', '.$paciente->nombre}}</td>
            <td width="10%" class="text-center"><strong>Sexo: </strong>{{$paciente->sexo}}</td>
            <td width="10%" class="text-center"><strong>Edad: </strong>{{\Carbon\Carbon::parse($paciente->nacimiento)->age}}</td>
        </tr>
        @endisset
        <tr>
            <td colspan="3" class="align-top" style="padding:5px;height:70%">
                <h5 class="mt-4">Rx.</h5>
                {!!$receta->descripcionReceta!!}
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                <p class="pequenio text-center">F:_________________________________</p>
                <p class="text-uppercase text-center pequenio"><strong>DR. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}} | J.V.P.M. {{$doctor->codigoDoctor}}</strong></p>
            </td>
        </tr>
    </table>

@endsection
@section('content-footer')
    <table class="mt-2">
        <tr>
            <td class="text-small">
                <table style="margin:10px">
                    @isset($clinica->facebook)
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/fb.png') }}" width="100%" height="auto" alt=""></td>
                        <td class="pl-1">{{$clinica->facebook}}</td>
                    </tr>
                    @endisset
                    @isset($clinica->paginaWeb)
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/puntero.png') }}" width="100%" class="mt-1" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->paginaWeb}}</td>
                    </tr>
                    @endisset
                    @isset($clinica->email)
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/email.png') }}" width="100%" class="mt-1" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->email}}</td>
                    </tr>
                    @endisset
                </table>
            </td>
            <td class="align-top text-small">
                <table style="margin:10px">
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/ubicacion.png') }}" width="100%" height="auto" alt=""></td>
                        <td class="pl-1">{{$clinica->direccion}}</td>
                    </tr>
                    <tr>
                        <td width="7%"><img src="{{ public_path('adjuntosdoctor/tel.jpg') }}" width="100%" class="mt-1" height="auto" alt=""></td>
                        <td class="pl-1"> {{$clinica->telefonos}} @isset($clinica->celular){{$clinica->celular}} @endisset </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection