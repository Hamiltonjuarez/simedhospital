@extends('theme.guest.layout')
@section('styles')
    <style>
      @media (orientation:landscape){
        .content-wrapper{
          background-image: url("{{asset('assets/img/landscape.jpg')}}");
          background-repeat: no-repeat;
          background-size: 100% 100%;
        }
      }
      @media (orientation:portrait){
        .content-wrapper{
          background-image: url("{{asset('assets/img/portrait.jpg')}}");
          background-repeat: no-repeat;
          background-size: 100% 100%;
        }
      }

    </style>
@endsection
@section('contenido')

@endsection
