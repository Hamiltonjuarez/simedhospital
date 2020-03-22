@extends('theme.lte.layout')
@section('styles')
<link href="{{asset('css/select.css')}}" rel="stylesheet"/> 
<style>
    .confirm-btn{
        background: #3CB554;
        border-radius: 10px;
        /* position: absolute;
        left: 100px; */
        color: white;
        width: 140px;
        height: 40px;
        cursor: pointer;       
        border:solid 1px green;
    }
    .cancel-btn{
        background: #0DFAD2;
        border:solid 1px lightseagreen;
       /*  position: absolute;
        left: 100px; */
        border-radius: 10px;
        padding-right: 10px;
        width: 140px;
        height: 40px;
        cursor: pointer;
        color: white;
    }
    .sheight{
        height: 320px;
    }
    .talign{
        text-align: center;
    }
</style>
@endsection
@section('contenido')
   <div class="card border-primary">
       <div class="card-header border-primary">
         <h4 style="padding-left: 40px">AGREGAR PAQUETE DE MEDICAMENTOS</h4>
       </div>
       <div class="card-body border-primary">
           <div class="row">
               <div class="col-md-5">
                <div class="card shadow-lg rounded" style="padding-top:10px">
                    <div class="card-header border-info">
                        <h5 style="padding-left: 150px"><b>CREAR PAQUETE</b></h5>
                      </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Digite nombre de paquete</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>    
                        </div>  
                        <label for="">Seleccione medicamentos o insumos de el paquete: </label>                     
                        <select  name="medicamentos" id="medicamentos" class="form-control selectpicker" data-live-search="true" > 
                           
                            <option value="" selected disabled>Seleccione medicamento</option>                  
                            @foreach ($medicamentos as $medicamento)
                                 <option value="{{$medicamento->id}}" id = "{{$medicamento->id}}">{{$medicamento->nombre." "."$".$medicamento->precioiva}}</option>                        
                            @endforeach                    
                        </select> 
                        <div class="cantidad" style="padding-top:20px">
                            <div class="form-group">
                               <p><b>Cantidad de medicamento:</b> </p>
                                <input type="number" class="form-control" style="width:25%" min="0" name="cantidad" id="cantidad">
                            </div>
                        </div>                        
                    </div>
                    <div class="card-footer border-info">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col">
                                <button class="btn btn-primary" onclick="addtocombo()"> Agregar a paquete</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
               </div>
               <div class="col" id="formcontainer">
                <div class="col">
                    <form action="{{route("inventarios.createcombo")}}" name="comboform" id="comboform" method="POST"> 
                      @csrf
                        <input type="hidden" name="contador" id="contador" value="">                                       
                    <div class="card shadow-lg" id="card" style="display:none">
                        <div class="card-header">
                            <input type="text" name="comobosend" id="comobosend" class="form-control talign" disabled>
                        </div>
                        <div class="card-body">
                          <div class="row">                    
                              <div class="form-group col-md-12" id="add">                        
                              </div>                   
                          </div> 
                          <div class="row">
                            <div class="col-md-8">
                              <label for="" style="padding-right:20px">Costo del paquete: </label>                                
                            </div>
                            <div class="col">
                              <div class="input-group mb-3" style="width:4cm; margin:auto">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                  </div>
                                  <input type="number" class="form-control" style="width:55%; margin:auto" min="0" step="2" name="costocombo" id="costocombo" disabled> 
                                </div>
                            </div>                              
                        </div>
                          <div class="row">
                              <div class="col-md-8">
                                <label for="" style="padding-right:20px">Precio del paquete: </label>                                
                              </div>
                              <div class="col">
                                <div class="input-group mb-3" style="width:4cm; margin:auto">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input type="number" class="form-control" style="width:55%; margin:auto" min="0" step="2" name="total" id="total" disabled> 
                                  </div>
                              </div>                              
                          </div>
                          <div class="r" style="/* border:solid black 2px;  */height:1px; padding-bottom:5px;">
                            <hr style="height:1px;background:#42DF95">
                        </div>
                          <div class="row justify-content-center" id="buttonenvio" style="display:none">            
                            <div class="col-md-12 text-center">
                                <div class="btns">
                                    <button type="button"  class="btn btn-primary btn-sm"  onclick="sendem()">Crear paquete</button>    
                                </div> 
                            </div>
                        </div>                                    
                   </div>
                  </div>
                  
                    </form>
              </div>
               </div>
           </div>
       </div>
   </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="{{asset('js/select.js')}}"></script>
<script>
    var contador = 0;
    var total = 0;
    var medicamentosarray = {!! json_encode($medicamentos->toArray()) !!};
    var costo = 0;
    var costomedicamento = 0;
    function addtocombo(){        
     var medicamento = $("#medicamentos").val();
     var cantidad = $('#cantidad').val();   
     var d = medicamento+"!"+cantidad;
     var nombreinput2 = "b[]"
     var comboname = $('#nombre').val();
     var leng = comboname.length;
    
     if(leng >0){         
         $('#nombre').removeClass('is-invalid');
         $('#comobosend').val(comboname);        
        if(medicamento != null){
           if(cantidad > 0){
            $('#cantidad').removeClass('is-invalid');
            contador ++;
            var card = document.getElementById('card');
            var btn = document.getElementById('buttonenvio');
            var selected = document.getElementById('medicamentos'); 
            medicamentosarray.forEach(element => {
                if(medicamento == element.id){
                    costomedicamento = element.costo;                  
                }
            });          
           if(contador > 1){
             btn.style.display = "block";
           }else{
              btn.style.display = "none";
           }          
              card.style.display="block";
              var texto = selected.options[selected.selectedIndex].text;
              var text2 = texto +" "+"|"+" "+cantidad+" "+"Unidades";

              var suv = texto.substr(texto.length - 5);
             var test = parseFloat(suv); 
                      
              if(isNaN(test) == true){
                 var suv2 = suv.substr(suv.length - 2);                 
                 sumando = parseFloat(suv2);
                 var multiplicando = sumando * cantidad;
                total = total + multiplicando;              
                final = total.toFixed(2); 
                
                /* var costo1 = costomedicamento * cantidad; */
                

                var mulcosto = costomedicamento * cantidad;
                var sumacosto = costo + mulcosto;               
                costo = sumacosto;
                       
               
                       
              }else{
                var multiplicando = test * cantidad;
                total = total + multiplicando;
                final = total.toFixed(2);  
                
                var mulcosto = costomedicamento * cantidad;
                var sumacosto = costo + mulcosto;               
                
                
                costo = sumacosto;             
              }
                $('#costocombo').val(costo);
                $('#total').val(final);

                var ul = document.createElement('ul');
                document.getElementById('add').appendChild(ul);
           
              var li = document.createElement('li');
              ul.appendChild(li);
              li.innerHTML+= ''+text2+'';               
              li.innerHTML += '<input type="hidden" " value= "'+d+'" id="'+d+'" name="'+nombreinput2+'"> <button type="button" class="btn btn-danger btn-sm pull-right">Eliminar</button> <hr>';
              li.innerHTML += '<input type="hidden" value = ""'+mulcosto+'"  id="'+mulcosto+'">'
              li.id = multiplicando; 
              li.onclick = function() { 
                var costoid =  document.getElementById(mulcosto);
                var costoeliminarid = costoid.id;
                var rescost = costo - costoeliminarid;
                var parsecosto = rescost.toFixed(2);
                costo = parsecosto;
                
                

                 var restando = li.id;
                total = total - restando;
                final = total.toFixed(2);
                $('#total').val(final);   
                this.parentNode.removeChild(this);                
               contador = contador - 1;               
               if(contador == 0){
                document.getElementById("card").style.display = "none";
               costo = 0;               
               }
               $('#costocombo').val(costo);
               if(contador == 1 ){                 
               btn.style.display = "none";                         
               } 
            }    
            $('#cantidad').val("");
           }else{
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'ingrese la cantidad de medicamento',
                showConfirmButton: false,
                timer: 1000
             });    
             $('#cantidad').addClass('is-invalid');
             $('#cantidad').focus();
           }
        }else{
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Seleccione un medicamento',
                showConfirmButton: false,
                timer: 1000
             }); 
             $('#medicamentos').addClass('is-invalid');
             $('#medicamentos').focus();  
        }
     }   
     else{
        Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Se necesita un nombre para el paquete',
                showConfirmButton: false,
                timer: 1000
             }); 
             $('#nombre').addClass('is-invalid');
             $('#nombre').focus();  
     }
    }
    function sendem(){
      var tot = $('#total').val();  
            const swalWithBootstrapButtons = Swal.mixin({ 
             allowOutsideClick: false,
            heightAuto: false,
            customClass: {                
                confirmButton: 'confirm-btn',
                cancelButton: 'cancel-btn'
            },           
            buttonsStyling: false,            
            })

            swalWithBootstrapButtons.fire({     
            allowOutsideClick: false,      
            heightAuto: false,
            title: 'Precio del paquete:'+' '+'$'+tot,
            text: "¿Cambiar total?",
            icon: 'info',
           /*  showConfirmButton: true, */
            buttonsStyling:false,           
           
            backdrop: 'swal2-backdrop-show',
            showCancelButton: true,
            confirmButtonText: 'Cambiar',           
            cancelButtonText: 'No cambiar',
            reverseButtons: true,            
            }).then((result) => {
            if (result.value) {
                Swal.fire({
                allowOutsideClick: false,
                showCancelButton: true,
                title: 'Digite el nuevo precio del paquete',
                input: 'number',
                inputAttributes: {
                autocapitalize: 'off',
                fix: 2,
                },
                preConfirm: (result) => {
                       if(result === null || result === '' || result === undefined){
                           Swal.showValidationMessage(
                               'Por favor digite el nuevo total'
                           );
                       }
                    },        
            }).then((number) => {
                    if(number.value){
                        var dato = number.value;
                        $('#total').val(dato);
                        document.getElementById('total').removeAttribute("disabled");
                        document.getElementById('comobosend').removeAttribute("disabled");
                        document.getElementById('costocombo').removeAttribute("disabled");
                        $('#comboform').submit();   
                    }else{
                        
                    }
                           
                })
            } else if ( result.dismiss === Swal.DismissReason.cancel) {     
                document.getElementById('total').removeAttribute("disabled");
                document.getElementById('comobosend').removeAttribute("disabled");  
                document.getElementById('costocombo').removeAttribute("disabled");         
                $('#comboform').submit();                
            }
            })
    }
</script>
@endsection