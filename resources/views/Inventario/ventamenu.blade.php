@extends('theme.lte.layout')
@section('styles') 
<link href="{{asset('css/select.css')}}" rel="stylesheet"/> 
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> --}}
<style>
.ass{
  
}
.b{
    display: block;
}
</style>
@endsection
@section('contenido')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-center">
                <h3>VENTA DE MEDICAMENTOS</h3>
            </div>
            <div class="col-md-6">
            <div class="row">
                <div class="col">
                    <form id="formlista" action="{{route('inventario.listaventas')}}">
                        <input type="hidden" id="idlista" name="idlista">
                        @csrf
                        <button type="button" id="listaventas" class="btn btn-primary pull-right" onclick="listaventass()">Listado de ventas</button>
                    </form>
                </div>
                <div class="col">
                    <a href="{{route('inventarios.index')}}" class="btn btn-secondary float-left">Listado de medicamentos</a>
                </div>
            </div>
                  
            </div>    
        </div> 

    </div>
    <div class="card-body">    
        <div class="row">   
           <div class="col-md-6"> 
            <div class="form-group">
                <div class="row">                   
                    <div class="col-md-2 text-center">
                         <label class="text-center" for="paciente">Paciente: </label>
                    </div>
                    <div class="col"></div>
                  @if(@isset($pacientes))  <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="ck" onclick="test3()">
                            <label class="form-check-label" for="defaultCheck1">
                               <p>   Cliente no registrado</p>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="selectdiv"> 
                    <select name="paciente" id="paciente" class="form-control selectpicker" size="1" data-live-search="true">
                        <option value="" disabled selected>Seleccione paciente</option>                   
                        @foreach ($pacientes as $paciente)
                            <option value="{{$paciente->id}}">{{$paciente->nombre." ".$paciente->apellidos}}</option>                            
                        @endforeach
                        </select>                  
                </div>  
            </div>
            <div class="form-group" id="textdiv">               
                <input type="text" class="form-control" name="ncliente" id="ncliente"  style="display:none">
            </div>
           <input type="hidden" value="{{$number}}" id="number">
            @else 
           </div>
           </div>
           <input type="hidden" value="{{$number}}" id="number">
            <div class="form-group">               
            <input type="text" class="form-control" name="ncliente" id="ncliente" value="{{$paciente->nombre." ".$paciente->apellidos}}" style="display:block" readonly>
            <input type="hidden" value="{{$paciente->id}}" id="pac">
            </div>
            @endif  
            <input type="hidden" id="pasostock">        
            <div class="form-group" id="selectdivi" >
                <label for="medicamentos">Seleccione medicamentos de venta</label>
                <select  name="medicamentos" id="medicamentos" class="form-control selectpicker" data-live-search="true" >  
                    <option value="" selected disabled>Seleccione medicamento</option>    
                    @foreach ($paquetes as $paquete)
                         <option value="paquete" id = "{{$paquete->id}}">{{$paquete->nombre}}</option>                        
                    @endforeach                  
                    @foreach ($medicamentos as $medicamento)
                         <option value="{{$medicamento->id}}" id = "{{$medicamento->id}}">{{$medicamento->nombre." ".$medicamento->Consentracion}}</option>                        
                    @endforeach                    
                </select>
            </div>
          <div class="col">
            <div class="form-group">
                <label for="cantidad">Digite la cantidad de medicamento</label>
                <input type="number" class="form-control" style="width:15%" min="0" name="cantidad" id="cantidad">
            </div>
          </div>
          <div class="col">
              <div class="form-group">
                  <button type="button" class="btn btn-primary" onclick="ajaxx()">Agregar</button>
              </div>
          </div>
        </div>
        <div class="col">
          <form action="{{route("inventarios.addventajax")}}" name="ventamenu" id="ventamenu" method="POST" target="_blank"> 
            @csrf
              <input type="hidden" name="contador" id="contador" value="">
              <input type="hidden" name="paciente_id" id="paciente_id" value="">
          <input type="hidden" name="nber" id="nber">             
          <div class="card" id="card" style="display:none">
              <div class="card-body">
                <div class="row">                    
                    <div class="form-group col-md-12" id="add">                        
                    </div>                   
                </div>                
         </div>
        </div>
        <div class="row justify-content-center" id="buttonenvio" style="display:none">            
            <div class="col-md-12 text-center">
                <div class="btns">
                    <button type="button"  class="btn btn-primary btn-sm"  onclick="test2()">Crear venta</button>    
                </div> 
            </div>
        </div>
    </div>
      </div>  
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> --}}
<script type="text/javascript" src="{{asset('js/select.js')}}"></script>
    <script>
        var cantli =0;
        var fruts = new Array();  

        function ajaxx(){            
            var valor = $('#cantidad').val();
            var idd = $('#medicamentos').val();
            if(idd == 'paquete'){
                test();
            }
            if(valor>0){
                $.ajax({
                url: '{{ route("inventarios.cuantoshay") }}',
                type: 'GET',
                data:{'idd':idd, '_token': '{{ csrf_token() }}'},
            success:function(response)
            { 
               
               if(parseInt(response.stock)>=valor){
                   test();
               }  else{
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'no hay suficiente en inventario',
                showConfirmButton: false,
                timer: 1000
             });
              var dato = document.getElementById('cantidad');
              dato.classList.add("is-invalid");
              dato.value = "";

               }           
            }
            });
          }else{
            document.getElementById('cantidad').focus();
             var dato = document.getElementById('cantidad');
             dato.classList.add("is-invalid");
          }
        }
        var conta = 0;
       function test(){                      
           var valor = $('#cantidad').val();
           var idd = $('#medicamentos').val();             
           var option = document.getElementById('medicamentos'); 
                   
            cantli = cantli +1;  
            document.getElementById('card').style.display = "block";  
            document.getElementById('ventamenu').style.display = "block";  
            document.getElementById('buttonenvio').style.display = "block";
             var a = $('#cantidad').val();
             var b = $('#medicamentos').val();            
             var ca = document.getElementById('medicamentos');
             var texto = ca.options[ca.selectedIndex].text;  
             var idpaquete = ca.options[ca.selectedIndex].id;           
            /* var dddd = ca.options[ca.selectedIndex].data-id;
             alert(dddd);  */       
           /*   var dadd = fruts[];
             mm = dadd.nombre;
             alert(mm); */
            
           /*   var c; */
             var c = texto+" "+"|"+" "+a+" "+"unidades";
            
             var d = b+"!"+a
             if(idd == 'paquete'){
                 c = texto;
                 d = b;
                
             }
             var nombreinput = "a[]";   
             var nombreinput2 = "b[]"          
             var obj = {
                 id: a+b, nombre: b, cantidad: a, 
             };
             fruts.push(obj);
             var ul = document.createElement('ul');
             ul.id= "lista";
	    	 document.getElementById('add').appendChild(ul);
             var li = document.createElement('li');
			 ul.appendChild(li);     
             li.innerHTML+= ''+c+''; 
             if(idd == 'paquete'){
                li.innerHTML += '<input type="hidden" " value= "'+idpaquete+'" id="'+d+'" name="'+nombreinput+'"> <button type="button" class="btn btn-danger btn-sm pull-right">Eliminar</button> <hr>';    
             }else{
                li.innerHTML += '<input type="hidden" " value= "'+d+'" id="'+d+'" name="'+nombreinput2+'"> <button type="button" class="btn btn-danger btn-sm pull-right">Eliminar</button> <hr>';
             }
                 
             
             li.id = a+b;
            
                                
             var dato = document.getElementById('cantidad');
             dato.classList.remove("is-invalid");
            $('#cantidad').val("");
             li.onclick = function() {                 
                this.parentNode.removeChild(this);                        
                var com = this.id;
                for (i=0; i<fruts.length; i++){
                      var dadd = fruts[i];
                      mm = dadd.id;
                      if(com == mm)
                      {
                         fruts.splice(i,1);
                      }
                }
               cantli = cantli - 1;              
               if(cantli == 0 ){                 
                document.getElementById('buttonenvio').style.display = "none";  
                document.getElementById("card").style.display = "none";
               } 
            }          
       }
       function test2(){
       var numb = $('#number').val();      
        if(numb == 1){
            if(document.getElementById('ck').checked){ 
                document.getElementById('nber').value = 2;          
                 var nams = $('#ncliente').val(); 
             }else{           
                  var nams = $('#paciente').val(); 
             }   
        }  
        else{
            nams = $('#pac').val();          
        }    
         if(nams !="" && nams != null){            
         $('#paciente_id').val(nams);  
         $('#contador').val(cantli);                       
          if(numb == 1){           
              var checked = $('#ncliente').val();
              if(checked != ""){
                document.getElementById("ventamenu").target = "_blank";
                $('#ventamenu').submit();
                window.location = "{{route('inventarios.index')}}";  
              }
            else{               
                document.getElementById("ventamenu").target = "_self";
                $('#ventamenu').submit(); 
            } 
          }else{
            document.getElementById("ventamenu").target = "_self";
            $('#ventamenu').submit();          
          }           
         }
         else{
            Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: 'Ingrese comprador',
            showConfirmButton: false,
            timer: 1000
            })
         }

             
               /* $.ajax({                     
                        url: '{{route("inventarios.addventajax")}}',
                        type: 'POST',                       
                        data:datoo , 

                        success:function(response)
                        {
                           console.log(response);
                        }                   
               });  */          
        
       }
       function test3(){
          if(document.getElementById('ck').checked){
             document.getElementById('textdiv').style.display="block";
             document.getElementById('selectdiv').style.display="none"; 
             document.getElementById('ncliente').style.display="block"; 
             var select = document.getElementById('paciente');
             select.selectedIndex=null;          
            
          }
          else{
              document.getElementById('textdiv').style.display = "none";
              document.getElementById('selectdiv').style.display = "block";
              document.getElementById('ncliente').style.display="none";
              document.getElementById('ncliente').value='';
          }
       }

       function listaventass(){
        var numb = $('#number').val();      
        if(numb == 1){
            if(document.getElementById('ck').checked){           
                 Swal.fire({
                 position: 'top-end',
                 icon: 'error',
                 title: 'seleecione un paciente',
                 showConfirmButton: false,
                 timer: 1000
                }) 
                var select = document.getElementById('paciente');
                select.selectedIndex=null; 
                document.getElementById('ncliente').value='';
                document.getElementById('ck').checked = false;
                document.getElementById('textdiv').style.display = "none";
                document.getElementById('selectdiv').style.display="block"; 
             }else{           
                  var envio = $('#paciente').val(); 
             }   
        }  
        if(numb == 2){
            envio = $('#pac').val();          
        } 
      
        if(envio != null){           
            if(envio !=""){               
                document.getElementById('idlista').value = envio;
                 $('#formlista').submit();           
            }else{
                Swal.fire({
                 position: 'top-end',
                 icon: 'error',
                 title: 'Seleccione paciente',
                 showConfirmButton: false,
                 timer: 1000
                }) 
            }
        }
        else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Seleccione paciente',
                showConfirmButton: false,
                timer: 1000
            }) 
        }    
       }
    
    </script>    
@endsection
{{-- 
@extends('theme.lte.layout')
@section('contenido')
    <div id="app-4">
        <input type="text" name="uno" id="" v->
        <ol>
          <li v-for="todo in todos">
            @{{ todo.text }}
          </li>
        </ol>
    </div>
@endsection
@section('scripts')
    <script>
        var app4 = new Vue({
        el: '#app-4',
            data: {
                todos: [
                    { text: 'Learn JavaScript' },
                    { text: 'Learn Vue' },
                    { text: 'Build something awesome' }
                ]
            }
        })
    </script>
@endsection --}}