@extends('procedimientos.layouts.doublepage')
@section('titulo')
    {{$pacientes->nombre.' '.$pacientes->apellidos}}
@endsection
@section('content-header')
    <table class=" text-center mt-2">
        <tr>
            <td><img src="{{public_path($doctor->logo)}}" width="400px" height="auto" alt="Logo"></td>
        </tr>
    </table>
    <table class="table-bordered text-center">
        <tr>
            <td>
                <h4 class="text-uppercase">Reporte de {{$tipo->procedimiento_nombre}}</h4>
            </td>
        </tr>
    </table>
@endsection
@section('content-main')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered pequenio mt-4" >
                    <tr>
                        <td colspan="3">
                            <p class="pequenio text-left text-capitalize"><b>Fecha: </b>{{ \Carbon\Carbon::parse($historial->created_at)->locale('es_Es')->isoFormat('dddd, LL') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td width="70%" class="text-left"><p class="pequenio"><b>Paciente: </b>{{$pacientes->nombre.' '.$pacientes->apellidos}}</p></td>
                        <td><p class="pequenio"><b>Sexo: </b>{{$pacientes->sexo}}</p></td>
                        <td><p class="pequenio"><b>Edad: </b>{{\Carbon\Carbon::parse($pacientes->nacimiento)->age}}</p></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="height:65%">
                            {!! $procedimiento->contenido!!}
                            </p>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="3">
                            <p><strong>F.____________________</strong></p>
                            <p><strong>Dr. {{$doctor->nombreDoctor.' '.$doctor->apellidosDoctor}}</strong></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('content-imagenes')
<table class=" text-center mt-2">
    <tr>
        <td><img src="{{public_path($doctor->logo)}}" width="400px" height="auto" alt="Logo"></td>
    </tr>
</table>
<table class="table-bordered text-center">
    <tr>
        <td>
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
        <td>@isset($img[0]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[0]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[0]) <p class="pequenio"> {{ $des[0] }} </p> @endisset</td>
        <td>@isset($img[1]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[1]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[1]) <p class="pequenio"> {{ $des[1] }} </p> @endisset</td>
        <td>@isset($img[2]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[2]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[2]) <p class="pequenio"> {{ $des[2] }} </p> @endisset</td>
    </tr>
</table>
<table class="text-center">
    <tr>
        <td>@isset($img[3]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[3]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[0]) <p class="pequenio"> {{ $des[3] }} </p> @endisset</td>
        <td>@isset($img[4]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[4]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[1]) <p class="pequenio"> {{ $des[4] }} </p> @endisset</td>
        <td>@isset($img[5]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[5]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[2]) <p class="pequenio"> {{ $des[5] }} </p> @endisset</td>
    </tr>
</table>
<table class="text-center">
    <tr>
        <td>@isset($img[6]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[6]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[0]) <p class="pequenio"> {{ $des[6] }} </p> @endisset</td>
        <td>@isset($img[7]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[7]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[1]) <p class="pequenio"> {{ $des[7] }} </p> @endisset</td>
        <td>@isset($img[8]) <img src="{{public_path()}}/capturas/{{$procedimiento->id.'/'.$img[8]}}" width="100%" height="auto" style="border-radius:5px" alt=""> @endisset @isset($des[2]) <p class="pequenio"> {{ $des[8] }} </p> @endisset</td>
    </tr>
</table>
@endsection
@section('content-footer')
<table class="text-center pequenio mt-2">
    <tr class="text-center">
        <td><p><img src="{{public_path('iconospdf/direccion.png')}}" class="icono" alt="">{{$clinica->direccion}}</p></td>
    </tr>
</table>
    <table class="pequenio align-top mt-1">
        <tr>
            @isset($clinica->telefonos)<td><p><img src="{{public_path('iconospdf/telefono.png')}}" class="icono" alt=""> {{$clinica->telefonos}}</p></td>@endisset
            </td>
            @isset($clinica->facebook)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/facebook.png')}}" class="icono" alt=""> {{$clinica->facebook}}</p> </td>@endisset
            @isset($clinica->celular)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/whatsapp.png')}}" class="icono" alt=""> {{$clinica->celular}}</p></td>@endisset
            @isset($clinica->instagram)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/instagram.png')}}" class="icono" alt=""> {{$clinica->instagram}}</p></td>@endisset
            @isset($clinica->paginaWeb)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/web.png')}}" class="icono" alt=""> {{$clinica->paginaWeb}}</p></td>@endisset
            @isset($clinica->email)<td> <p style="margin-top:1px"><img src="{{public_path('iconospdf/email.png')}}" class="icono" alt=""> {{$clinica->email}}</p></td>@endisset
        </tr>
    </table>
@endsection