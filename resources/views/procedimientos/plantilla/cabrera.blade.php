@extends('procedimientos.layouts.doublepage')
@section('titulo')
    {{$pacientes->nombre.' '.$pacientes->apellidos}}
@endsection
@section('content-header')
    <div class="logo">
        <img src="{{ public_path($doctor->logo)}}" class="img-logo" alt="">
    </div>
    <div class="encabezado p-2">
        <hr class="bg-primary">
        <h5 class="titulo-doctor">{{$doctor->tituloDoctor}}</h5>
        @if(Auth::user()->doctor_id == 12)
        <div class="fondo p-1">
            CIRUJANO ENDOSCOPISTA. BECARIO DE LA ORGANIZACIÓN MUNDIAL DE GASTROENTEROLOGÍA (WG0) EN EL INSTITUTO DE GASTROENTEROLOGIA BOLIVIANO-JAPONES. LA PAZ, BOLIVIA.
        </div>
        @endif
        <hr class="bg-black">
    </div>
@endsection
@section('content-main')
    <div class="container datos-paciente">
        <div class="row p-2">
            <div class="col-xs-12">
                <table class="table-info-paciente">
                    <tr>
                        <td  width="30%">Nombre:</td>
                        <td>{{$pacientes->nombre.' '.$pacientes->apellidos}}</td>
                    </tr>
                    <tr>
                        <td  width="30%">Edad:</td>
                        <td>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}} años.</td>
                    </tr>
                    <tr>
                        <td  width="30%">Sexo:</td>
                        <td>{{$pacientes->sexo}}</td>
                    </tr>
                    @isset($infoproc->expediente)
                    <tr>
                        <td  width="30%">Expediente:</td>
                        <td>{{$infoproc->expediente}}</td>
                    </tr>
                    @endisset
                    <tr>
                        <td  width="30%">Fecha:</td>
                        <td>{{ \Carbon\Carbon::parse($procedimiento->created_at)->locale('es_Es')->isoFormat('dddd, LL')}}</td>
                    </tr>
                    @isset($infoproc->procedencia)
                    <tr>
                        <td  width="30%">Procedencia:</td>
                        <td>{{$infoproc->procedencia}}</td>
                    </tr>
                    @endisset
                    @isset($infoproc->diagnostico_clinico)
                    <tr>
                        <td  width="30%">Diagnóstico clínico:</td>
                        <td>{{$infoproc->diagnostico_clinico}}</td>
                    </tr>
                    @endisset
                    <tr>
                        <td  width="30%">Estudio:</td>
                        <td>{{$tipo->procedimiento_nombre }}</td>
                    </tr>
                    @isset($infoproc->intervencion)
                    <tr>
                        <td  width="30%">Intervencion:</td>
                        <td>{{$infoproc->intervencion }}</td>
                    </tr>
                    @endisset
                    @isset($infoproc->anestesia)
                    <tr>
                        <td  width="30%">Anestesia:</td>
                        <td>{{$infoproc->anestesia}}</td>
                    </tr>
                    @endisset
                    @isset($infoproc->anestesiologo)
                    <tr>
                        <td  width="30%">Anestesiologo:</td>
                        <td>{{$infoproc->anestesiologo }}</td>
                    </tr>
                    @endisset
                    @isset($infoproc->equipo)
                    <tr>
                        <td width="30%">Equipo:</td>
                        <td>{{$infoproc->equipo }}</td>
                    </tr>
                    @endisset
                </table>
            </div>
        </div>
    </div>
    <div class="container descripcion mt-2">
        <div class="row">
            <div class="col-xs-12">
                {!! $procedimiento->contenido !!}
            </div>
        </div>
    </div>
@endsection
@section('content-footer')
    <div class="firma text-center">
        <p class="p-firma">F.______________________</p>
        <p class="p-firma">{{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</p>
        <p class="p-firma">J.V.P.M.: {{$doctor->codigoDoctor}}</p>
    </div>
    @if(Auth::user()->doctor_id == 12)
    <img src="{{ public_path('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/footerleft.png')}}" alt="" width="75px" class="img-left">
    <img src="{{ public_path('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/footerright.png')}}" alt="" width="75px" class="img-right">
     <hr style="background-color: blueviolet;margin:0%;margin-top:80px;">
    <div class="direccion text-center">
        <p>Centro Médico JABES, 13 Avenida Sur, entre 5ª y 7ª Calle Oriente # 11. Santa Ana. Tel: 2441-1723 / 7129-4656 / 7828-8068</p>
    </div>
    @endif
@endsection
@section('content-imagenes')
    <div class="logo">
        <img src="{{ public_path($doctor->logo)}}" class="img-logo" alt="">
    </div>
    <div class="encabezado p-2">
        <hr class="bg-primary">
        <div class="fondo p-1 text-uppercase" style="font-size:16px">
            Informe fotografico
        </div>
        <hr class="bg-black">
    </div>
    <div class="container mt-4" style="position:relative">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered text-center" style="font-size:12px">
                    <tr>
                        <td class="text-left" colspan="3">
                            <p >Paciente: {{$pacientes->nombre.' '.$pacientes->apellidos}}</p>
                            <p >Fecha: {{ \Carbon\Carbon::parse($procedimiento->created_at)->locale('es_Es')->isoFormat('dddd, LL')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>@isset($img[0]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="220px" alt=""> @endisset @isset($des[0]) <p> {{ $des[0] }} </p> @endisset</td>
                        <td>@isset($img[1]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="220px" alt=""> @endisset @isset($des[1]) <p> {{ $des[1] }} </p> @endisset</td>
                        <td>@isset($img[2]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="220px" alt=""> @endisset @isset($des[2]) <p> {{ $des[2] }} </p> @endisset</td>
                    </tr>
                    <tr>
                        <td>@isset($img[3])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="220px" alt=""> @endisset @isset($des[3]) <p> {{ $des[3] }} </p> @endisset</td>
                        <td>@isset($img[4])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" width="220px" alt=""> @endisset @isset($des[4]) <p> {{ $des[4] }} </p> @endisset</td>
                        <td>@isset($img[5])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" width="220px" alt=""> @endisset @isset($des[5]) <p> {{ $des[5] }} </p> @endisset</td>
                    </tr>
                    <tr>
                        <td>@isset($img[6])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[6]}}" width="220px" alt=""> @endisset @isset($des[6]) <p> {{ $des[6] }} </p> @endisset</td>
                        <td>@isset($img[7])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[7]}}" width="220px" alt=""> @endisset @isset($des[7]) <p> {{ $des[7] }} </p> @endisset</td>
                        <td>@isset($img[8])<img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[8]}}" width="220px" alt=""> @endisset @isset($des[8]) <p> {{ $des[8] }} </p> @endisset</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
