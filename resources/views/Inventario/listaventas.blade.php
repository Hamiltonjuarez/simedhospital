@extends('theme.lte.layout')
@section('styles')
    <style>
        /* .aaaa{
            /* text-transform: uppercase; */
          /*   font-size: 26px;
        } */  
        .aa{
            width: 25cm;            
        }
        .aaaaa{
           border: solid 2px #16C7CA;
           border-radius: 10px;
           padding: 4px;
           width: 18cm;
        }
        .aaaa{
            font-size: 20px;
            
        }
        .border{
            border: solid black 2px;
        }
        /* .bord{
            position: fixed;
            left: 7.5cm;
            width: 21cm;
            border: solid black 2px;
            height: 1.0cm;
        } */
    </style>
@endsection
@section('contenido')
   <div class="container">
    <div class="aaa card ">
        <div class="card-header">
       <div class="row">
           <div class="col-md-9">
             <h4 class="a ">HISTORIAL DE MEDICAMENTOS </h4>
           </div>
           <div class="col">             
                 <form action="{{route('inventario.addventaperfil',[$paciente->id])}}" method="GET" id="ventapaciente">
                     @csrf           
                     <button class="btn btn-primary btn-sm" type="submit" >Agregar medicamentos/insumos</button>
                 </form>        
         </div>        
      </div>
    </div>   
      <div class="bord"></div>
      <br>
      <div class="row">
          <div class="col-md-2"></div>
          <div class="aaaaa col-md-6">
            <h4 class="text-center">  {{$paciente->nombre." ".$paciente->apellidos}}</h4>
          </div>
          <div class="col"></div>
      </div>

        <div class="card-body">
           
         @if(count($ventas)>0)
         <ul class="aa timeline timeline-inverse ">
             @foreach ($ventas as $venta)                
                 <li class="time-label">
                     <span class="bg-info">
                         {{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y - h:i a')}}
                     </span>
                 </li>
                 <li>
                 <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                     <h3 class="timeline-header" style="color:blue">
                         Registro de venta
                     </h3> 
                     <div class="timeline-body">
                       @foreach ($totales as $total)
                           @if ($venta->id == $total->venta_id)
                               <p class="aaaa">  Total de medicamentos: <u> {{$total->total}}</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info btn-sm" id="{{$venta->id}}e" onclick="wherethemagichappens({{$venta->id}})">+</button>  </p>                       
                           @endif
                       @endforeach
                     <div class="hidden" id="{{$venta->id}}"  style="display:none">
                          <ul class="list-group">
                            @foreach ($medicamentos as $medicamento)
                                @if ($venta->id == $medicamento->venta_id)
                                    @if ($medicamento->cantidad >1)
                                        <li class="list-group-item list-group-item-info">  {{$medicamento->cantidad." "."unidades de "." ".$medicamento->nombre." "."de"." ".$medicamento->Consentracion}} </li>
                                   @else 
                                         <li class="list-group-item list-group-item-info">  {{$medicamento->cantidad." "."unidad de "." ".$medicamento->nombre." "."de"." ".$medicamento->Consentracion}} </li>      
                                   @endif                        
                                @endif
                           @endforeach
                          </ul>
                          <br>
                       </div>
                        <p class="aaaa">  Total facturado : $<u> {{$venta->total_venta}}</u></p> 
                        <hr>
                     </div>
                     <div class="timeline-footer">
                     <a href="{{route('inventario.verventa',$venta->id)}}" target="_blank" title="imprimir anexo" class="btn btn-sm btn-primary"> Imprimir</a>
                     </div>                                                  
                 </div> 
                 </li>
              @endforeach
         </ul>
         @else
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col">
                <div class="card" style="width:45rem;">
                    <div class="card-header">
                        <h3 class="text-center">!Aun no hay registro de ventas¡</h3> <br>
                    </div>
                    <div class="card-body">
                        <div class="row">              
                            <div class="col">
                               <a href="{{route('pacientes.index')}}" class="btn btn-primary btn-sm pull-right">Listado de pacientes </a>
                            </div>
                            <div class="col">
                               <form action="{{route('inventario.addventaperfil',[$paciente->id])}}" method="GET" id="ventapaciente">
                                   @csrf           
                                   <button class="btn btn-primary btn-sm" type="submit" >Crear venta para paciente </button>
                               </form>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
               
         @endif
        </div>
     </div>
   </div>
@endsection
@section('scripts')
    <script>
        var contador = 0;
        var e = "e";
        function envio(){
            window.location = "{{route('inventarios.index')}}";  
        }
        function wherethemagichappens(dato){            
            document.getElementById(dato).style.display = "block";
            document.getElementById(dato+e).innerHTML = "-";
            contador++;
            if(contador>1){
             document.getElementById(dato).style.display = "none";
             document.getElementById(dato+e).innerHTML = "+";
             contador = 0;   
            }
        }
    </script>
@endsection