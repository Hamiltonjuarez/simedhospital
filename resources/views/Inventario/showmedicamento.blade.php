@extends('theme.lte.layout')
@section('styles')
    <style>
        .a{
            text-align: center;
        }
        .aa{
            color: #2A8BC2;
            text-transform: uppercase;
        }
    </style>
@endsection
@section('contenido')
<div class="card">
    <div class="card-header" style="padding-left:3%">
        <div class="row">   
      <div class="col ">
      <h2 class="aa text-center"> {{" ".$medicamento->nombre}}</h2>
      </div>
      <div class="col">
        <a href="{{route('inventarios.index')}}" class="btn btn-primary pull-right">Regresar a listado</a>
      </div>
    </div>
    </div>
    <div class="card-body" style="padding-left:3%">
         @include('Inventario.agregarstock')  
    <div class="row">
        <div class="col">
           <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="card">
                    <div class="card-header text-center">
                        <h4> ENTRADAS DE MEDICAMENTO</h4>
                    </div>
                    <div class="card-body">
                        @if (count($entradas)>0)
                        <table class="a table table-bordered">
                                <thead class="table-info">
                                        <tr>
                                            <th scope="col">Cantidad</th>                                  
                                            <th scope="col">Proveedor</th> 
                                            <th scope="col">Fecha de ingreso</th>                       
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entradas as $entrada)
                                        <tr>
                                            <th scope="col">{{$entrada->cantidad}}</th>
                                            <th scope="col">{{$entrada->proveedor}}</th>
                                            <th scope="col">{{date('d-m-Y', strtotime($entrada->fecha_ingreso))}}</th>                                      
                                        </tr>
                                    @endforeach                          
                                </tbody>
                        </table>  
                        {{$entradas->links()}}
                        @else
                            <div class="card">
                                <div class="card-body text-center">
                                    <H4>AUN NO HAY ENTRADAS DE ESTE MEDICAMENTO</H4> <br>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-md" onclick="test()">Agregar a stock</button>
                                       {{--  <a href="{{route('inventarios.index')}}" class="btn btn-secondary" data-dismiss="modal">Regresar a listado</a> --}}
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
               </div>
           </div>
        </div>
        <div class="col">
         <div class="shadow p-3 md-5 bg-white rounded">
            <div class="card">
                <div class="card-header text-center">
                     <h4> SALIDAS DE MEDICAMENTO</h4>
                </div>
                <div class="card-body">
                    @if (count($salidas)>0)
                        <table class="a table table-bordered">
                            <thead class="table-info">
                                    <tr>
                                        <th scope="col">Cantidad</th>                                  
                                        <th scope="col">Cliente</th> 
                                        <th scope="col">Fecha de venta</th>                       
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach ($salidas as $salida)
                                    <tr>
                                        <th scope="col">{{$salida->cantidad}}</th>
                                        <th scope="col">{{$salida->nombre." ".$salida->apellidos}}</th>
                                        <th scope="col">{{date('d-m-Y', strtotime($salida->created_at))}}</th>                                      
                                    </tr>
                                @endforeach                          
                            </tbody>
                        </table>
                        {{$salidas->links()}}                        
                    @else
                    <div class="card">
                            <div class="card-body">
                                <H3 class="text-center"> AUN NO HAY SALIDAS DE ESTE MEDICAMENTO</H3><br>
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-6">
                                        <a href="{{route('inventarios.ventamenu')}}" class="btn btn-primary">Crear venta</a>
                                        {{-- <a href="{{route('inventarios.index')}}" class="btn btn-secondary" >Regresar a listado</a> --}}
                                    </div>
                                    <div class="col"></div>
                                </div>                        
                            </div>
                        </div>
                    @endif
                </div>
            </div>
         </div>
        </div>
    </div>
       
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function test(){
            $("#agregarstock").modal("show");        
            var sites = {{$id}};       
            $('#medicamento_id').val(sites);  
        }
        function probando(){ 
        var cantidad = $('#cantidad').val();
        if(cantidad != ""){
        document.getElementById('cantidad').classList.remove("is-invalid");
        var proveedor = $('#proveedor').val();
        if(proveedor != ""){
            document.getElementById('proveedor').classList.remove("is-invalid");
            var fechain = $('#fechain').val();
            if(fechain != ""){
                document.getElementById('fechain').classList.remove("is-invalid");
                var fechaout = $('#fechaexp1').val();
                if(fechaout != ""){
                        var fechaexpp =document.getElementById('fechaexp1').value;
                        var dato = moment(fechaexpp);    
                        var now = moment();
                        var compare = moment(dato).isAfter(now);
                    if(compare == true){
                        document.getElementById('fechaexp1').classList.remove("is-invalid");
                        var fechainn =document.getElementById('fechain').value;
                        var fecha = moment(fechainn);    
                        var ahora = moment();
                        var compare2 = moment(fecha).isAfter(ahora);
                      if(compare2 == true){
                        $('#addstock').submit();
                      }else{
                        document.getElementById('fechain').focus;
                        document.getElementById('fechain').classList.add("is-invalid"); 
                      }
                }else{
                    document.getElementById('fechaexp1').focus;
                    document.getElementById('fechaexp1').classList.add("is-invalid"); 
                    }
                }else{
                    document.getElementById('fechaexp1').focus;
                    document.getElementById('fechaexp1').classList.add("is-invalid");
                }
            }else{
                document.getElementById('fechain').focus;
                document.getElementById('fechain').classList.add("is-invalid");
            }
        }else{
            document.getElementById('proveedor').focus;
            document.getElementById('proveedor').classList.add("is-invalid")
        }
        }else{
        document.getElementById('cantidad').focus;
        document.getElementById('cantidad').classList.add("is-invalid");
        }
    }
    </script>
@endsection