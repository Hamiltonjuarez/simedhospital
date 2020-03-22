@extends('theme.lte.layout')
@section('contenido')
<div class="container-fluid p-2">
    <div class="row rounded-top" style="background-image: url({{asset('assets/img/enfermera.jpg')}}); background-position:relative; background-repeat:no-repeat ">
        <div class="container text-center" style="color:white">
            <h3 class="card-title py-3 font-weight-bold"><strong> <img class="profile-user-img img-fluid img-circle"
                src="{{asset('assets/img/avatarMedico.jpg')}}" alt="User profile picture"></strong>
            </h3>
            <h4> <i class="nav-icon fa fa-user-md" ></i> <strong>Dr. {{$doctor->apellidosDoctor}} {{$doctor->nombreDoctor}}</strong></h4>
            <h6><strong>{{$especialidad->specialty_name}}</strong></h6>
        </div>
    </div>
    <div class="row ">
        <div class="col-sm-3 text-center border-bottom border-right menuDoctor p-1">
            <a href="#">
                <i class="fa fa-lg fa-calendar-check-o" aria-hidden="true"></i>
                <p>Agenda</p>
            </a>
        </div>
        <div class="col-sm-3 text-center border-bottom border-right menuDoctor p-1">
            <a href="#">
                <i class="fa fa-users" aria-hidden="true"></i>
                <p>Pacientes</p>
            </a>
        </div>
        <div class="col-sm-3 text-center border-bottom border-right menuDoctor">
            <a href="#">
                <i class="fa fa-users" aria-hidden="true"></i>
                <p>Pacientes</p>
            </a>
        </div>
        <div class="col-sm-3 text-center border-bottom menuDoctor">
            <a href="#">
                <i class="fa fa-users" aria-hidden="true"></i>
                <p>Pacientes</p>
            </a>
        </div>
    </div>
</div>
@endsection
