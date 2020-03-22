@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
   <div class="row d-flex justify-content-center" style="text-align:center">
       <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Seleccione habitacion</h2>
            </div>
            <div class="card-body">
             @foreach ($habitaciones as $item)
                  <button class="btn btn-primary" id="{{$item->id}}" onclick="redirecion({{$item->id}})">{{$item->habitacion_nombre}}</button> <hr>
             @endforeach
            </div>
        </div>
       </div>
   </div>
@endsection
@section('scripts')
    <script>
        function redirecion(habitacion){           
            window.location="{{route('estacion.area')}}"+'/'+habitacion;
        }
    </script>
@endsection