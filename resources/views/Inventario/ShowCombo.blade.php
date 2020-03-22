@extends('theme.lte.layout')
@section('styles')
    
@endsection
@section('contenido')
   <div class="card">
       <div class="card-header">
        <div class="row">
            <div class="col">
                <h3>Combo de medicamentos/insumos</h3>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="{{route('inventarios.index')}}" class="btn btn-primary float-left">Listado de medicamentos</a>
            </div>
        </div>
       </div>
       <div class="card-body d-flex justify-content-center">
       <h4 > {{$combo->nombre}}</h4>
       </div>
   </div>
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-start" style="padding-left:40px;">
                <div class="col  d-flex justify-content-center"> <h5>Costo del paquete: ${{$combo->costo}}</h5></div>
                <div class="col  d-flex justify-content-center">
                <h5>Precio del paquete: ${{$combo->precio}}</h5>
                </div>               
            </div>
            <hr>
        </div>
        <div class="card-footer">
            <h5 style="padding-bottom:30px; padding-left:20px">Medicamentos del paquete:</h5>
           <div class="row">
                @foreach ($medicamentos as $medicamento)
                    <div class="col-md-4">
                        <div class="card shadow-lg">
                           <div class="card-header d-flex justify-content-center">
                              <h5><b> {{$medicamento->nombre}}</b></h5>
                           </div>
                           <div class="card-body">
                           <p>Concentración: {{$medicamento->Consentracion}}</p>
                           <p>Cantidad: {{$medicamento->cantidad}}</p>
                           </div>
                        </div>
                    </div>
               @endforeach
           </div>
        </div>
    </div>
@endsection