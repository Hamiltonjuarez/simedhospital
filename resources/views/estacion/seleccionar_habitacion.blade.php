@extends('theme.lte.layout')
@section('styles')
    <style>
        
        .fa-bed, 
        .fa-heartbeat,
        .fa-flask,
        .fa-medkit,
        .fa-file-excel-o{
            font-size: 48px;
        }

        .text-bed{
            font-weight: bold;
        }
        /* .fa-bed
        .fa-heartbeat
        fa-flask
        fa-medkit
        file-excel-o */
    </style>
@endsection
@section('contenido')
    <div id='habitaciones'>
        @foreach ($areas as $area)
            @if ($area_id==0 or $area_id != $area->area_id)
                @if ($area_id!=0)
                            </div>
                        </div>                
                    </div> 
                </div>
                @endif
                <div class="row">
                    <div class="col sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{$area->nombre_area}}</h4>
                            </div>
                            <div class="card-body">
                            @if ($area->estado=='libre')
                                <button class="btn btn-success" onclick="redirecion({{$area->id}})"><i class="fa {{ $area->icon }}"></i> <br> <span class="text-bed">{{$area->habitacion_nombre}}</span> </button>
                            @else
                                <button class="btn btn-warning" onclick="redirecion({{$area->id}})"><i class="fa {{ $area->icon }}"></i> <br> <span class="text-bed">{{$area->habitacion_nombre}}</span> </button>
                            @endif
            @else
                @if ($area->estado=='libre')
                    <button class="btn btn-success" onclick="redirecion({{$area->id}})"><i class="fa {{ $area->icon }}"></i> <br> <span class="text-bed">{{$area->habitacion_nombre}}</span> </button>
                @else
                    <button class="btn btn-warning" onclick="redirecion({{$area->id}})"><i class="fa {{ $area->icon }}"></i> <br> <span class="text-bed">{{$area->habitacion_nombre}}</span> </button>
                @endif
            @endif
            @php
            $area_id = $area->area_id; 
            @endphp
        @endforeach
    </div>    
    
    
@endsection
@section('scripts')
    <script>
    
        function redirecion(habitacion){           
            window.location="{{route('estacion.area')}}"+'/'+habitacion;
        }    

    </script>
@endsection