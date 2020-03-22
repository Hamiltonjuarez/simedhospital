@extends('procedimientos.layouts.singlepage')
@section('titulo')
    {{$pacientes->nombre.' '.$pacientes->apellidos}}
@endsection
@section('content-header')
    <table>
        <tr>
            <td width="45%">
                <img src="{{public_path($doctor->logo)}}" width="100%" height="150px" alt="">
                <h6 class="text-capitalize" style="margin:0%">Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</h6>
                 @if($doctor->codigoDoctor != null)<p class="pequenio" style="margin:0%"><b>JVPM:</b> {{$doctor->codigoDoctor}}</p>@endif
            </td>
            <td class="align-top">
                <p class="pequenio text-right" >{{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</p>
            </td>
        </tr>
    </table>
@endsection
@section('content-main')
    <table class="table-bordered text-center">
        <tr>
            <td colspan="3">
                <h4 class="text-uppercase">Reporte de {{$tipo->procedimiento_nombre }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <p class="text-capitalize pequenio text-left"><b>Paciente: </b>{{$pacientes->nombre}}</p>
            </td>
            <td>
                <p class="pequenio"><b>Sexo: </b>{{$pacientes->sexo}}</p>
            </td>
            <td>
                <p class="pequenio"><b>Edad: </b>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}}</p>
            </td>
        </tr>
    </table>
    <table class="text-center">
        <tr>
            <td>@isset($img[0]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[0]) <p class="pequenio"> {{ $des[0] }} </p> @endisset</td>
            <td>@isset($img[1]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[1]) <p class="pequenio"> {{ $des[1] }} </p> @endisset</td>
            <td>@isset($img[2]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[2]) <p class="pequenio"> {{ $des[2] }} </p> @endisset</td>
        </tr>
    </table>
    <table class="text-center">
        <tr>
            <td>@isset($img[3]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[3]) <p class="pequenio"> {{ $des[3] }} </p> @endisset</td>
            <td>@isset($img[4]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[4]) <p class="pequenio"> {{ $des[4] }} </p> @endisset</td>
            <td>@isset($img[5]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[5]) <p class="pequenio"> {{ $des[5] }} </p> @endisset</td>
        </tr>
    </table>
    <table class="pequenio table-bordered">
        <tr>
            <td>
                {!!$procedimiento->contenido!!}
            </td>
        </tr>
    </table>
@endsection
@section('content-footer')
    <table>
        <tr>
            <td width="55%">
                @isset($clinica->direccion)<p class="pequenio"><b>Dirección: </b>{{$clinica->direccion}}</p>@endisset
                @isset($clinica->telefonos)<p class="pequenio"><b>Tel. </b>{{$clinica->telefonos}}</p>@endisset
                @isset($clinica->celular) <p class="pequenio"><b>Cel. </b>{{$clinica->celular}}</p>@endisset
            </td>
            <td class="text-center">
                <p class="pequenio"><strong>F.____________________</strong></p>
                <p class="pequenio text-capitalize"><strong>Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</strong></p>
            </td>
        </tr>
    </table>
@endsection