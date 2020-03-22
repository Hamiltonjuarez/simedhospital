@extends('theme.lte.layout')
@section('styles')
   <style>
        .user-email {
            font-size: .85rem;
            margin-bottom: 1.5em;
        }
   </style>
@endsection
@section('contenido')
    <div style="background-size:cover; background-image: url({{ asset('/assets/img/enfermera.jpg') }}); background-position: center center;position:absolute; top:0; left:0; width:100%; height:400px;"></div>
    <div style="height:250px; display:block; width:100%"></div>
    <div style="position:relative; z-index:9; text-align:center;">
        <img src="@if(Auth::user()->avatar == null) {{asset('users/default.png')}}@else {{asset(Auth::user()->avatar)}}@endif"
             class="avatar"
             style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
             alt="{{ Auth::user()->name }} avatar">
        <h4>{{ ucwords(Auth::user()->name) }}</h4>
        <div class="user-email text-muted">{{ ucwords(Auth::user()->email) }}</div>
        <a href="{{route('doctores.profile', $doctor->id)}}" class="btn btn-primary">{{ __('Editar mi pérfil') }}</a>
       {{--  <p>{{ Auth::user()->bio }}</p>
        @if ($route != '')
           
        @endif --}}
    </div>
@endsection