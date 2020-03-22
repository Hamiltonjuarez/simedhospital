@extends('theme.lte.layout')
@section('styles')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<style>
  .btns{
    width: 0.7cm;    
  }
  .btnss{
    padding-right: 3px;
  }  
 table > tbody > tr {
    cursor: pointer;    
}
.red{
  background: #D15757;  
  color: azure;
}
.red :hover{
  color: black;
}
.blue{
  background: whitesmoke;
}
.menu{
  background: whitesmoke;
}

table > tbody > tr:hover{
            background-color: #99ccff;
            color: black;
        }
.idinventario{
    display: none;
}
.idpaque{
    display: none;
}
.selectpaquetes{
  color: white;
  background: #177AB9;
}
.selectpaquetes :focus{
  cursor: pointer;
  border-color: #FF0000;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
}

</style>
@endsection
@section('contenido')
@if (Session::has('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
        &times;
    </button>
    {{Session::get('exito')}}
</div>
@endif
    <div class="container-fluid">
        <div class="card">
            <div class="card-header border-primary">
                <div class="row">
                  <div class="col-md-8 d-flex justify-content-start">
                   <div class="row">
                     <div class="col-md-6"> <h4 class=" text-uppercase">
                      Inventario
                      </h4>
                    </div>
                     <div class="col-md-6 d-flex justify-content-end">                     
                      <select class="selectpaquetes form-control" id="selector" style="width:auto;" onchange="seleccion()">
                        <option selected value="1">Medicamentos</option>
                        <option value="2">Paquetes</option>                       
                      </select>                       
                     </div>
                   </div>

                </div>
                    <div class="col d-flex justify-content-start">
                      <div class="btn-group dropright ">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Opciones
                        </button>
                        <div class="dropdown-menu menu">
                         <div style="padding-bottom:3px;padding-left:5px;padding-right:5px"> <a href="" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#nuevoMedicamento" style="width:100%">NUEVO MEDICAMENTO/INSUMO</a> </div>                      
                         <div style="padding-bottom:3px;padding-left:5px;padding-right:5px"> <a href="{{route('inventarios.agregarcombo')}}" class="btn btn-sm btn-info" style="width:100%">NUEVO  PAQUETE</a></div>
                          <div style="padding-bottom:3px;padding-left:5px;padding-right:5px"><a href="{{route('inventarios.ventamenu')}}" class="btn btn-sm btn-info" style="width:100%">CREAR VENTA</a></div>
                        </div>
                      </div>
                    </div>                   
                </div>
            </div>
            <div class="card-body">
                @if($inventario->count()>0)
                <div class="table-responsive" id="tablamedicamentos">
                  <table class="table table-sm table-bordered" width="32.7cm" id="inventario" >
                    <thead class="text-uppercase bg-info">
                        <tr>
                            <th style="display:none">id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Concentracion</th>
                            <th>Fabricante</th>
                            <th>Stock</th>
                            <th>Costo</th>
                            <th>precio</th>
                            <th>precio con IVA</th>
                            <th>Fecha expiracion</th>
                            <th >Acciones medicamentos</th>
                        </tr>
                    </thead>                                               
                </table>
                </div>
                @endif   
               {{--  @if($combos->count()>0) --}}
              <div id="tablapaquetes" class="table-responsive" style="display:none">
                  <table class="table table-sm table-bordered" width="31.0cm" id="paquetes" >
                    <thead class="text-uppercase bg-info">
                        <tr class="text-center">
                            <th style="display:none">id</th>                            
                            <th>Nombre del paquete</th>
                            <th>costo</th>
                            <th>precio</th>                            
                            <th >Acciones </th>
                        </tr>
                    </thead>                                               
                </table>
                </div>
               {{--  @endif       --}}                           
            </div>
        </div>
    </div>
    <form action="{{route('inventarios.eliminarmedicamento')}}" method="POST" name="deletetarget" id="deleteform">
      @csrf
    <input type="hidden" name ="idaborrar" id="idaborrar" value="">   
   </form>

  <form action="{{route('inventarios.showcombo')}}" method="GET" id="showcombo">
    @csrf
    <input type="hidden" name="idcombo" id="idcomb">
  </form>
<form action="{{route('inventarios.deletecombo')}}" method="POST" id="deletecomboform">
  @csrf
  <input type="hidden" id="deletecomboid" name="deletecomboid">
</form>
    @include('Inventario.nuevoMedicamento')
    @include('Inventario.agregarstock')  
    @include('Inventario.editarmedicamento')    
    @include('Inventario.Editarpaquete')
    @endsection    
@section('scripts')
<script>

</script>
  <script>   
      $(document).ready(function() {
        $('#inventario').DataTable( {
            language: {
               "decimal": "",
               "emptyTable": "No hay información",
               "info": "Mostrando _START_ a _END_ de _TOTAL_  Medicamentos",
               "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
               "infoFiltered": "(Filtrado de _MAX_  total  Medicamentos)",
               "infoPostFix": "",
               "thousands": ",",
               "lengthMenu": "Mostrar _MENU_  Medicamentos",
               "loadingRecords": "Cargando...",
               "processing": "Procesando...",
               "search": "Buscar:",              
               "zeroRecords": "Sin resultados encontrados",
               "deferRender": true,
               "paginate": {
                   "first": "Primero",
                   "last": "Ultimo",
                   "next": "Siguiente",
                   "previous": "Anterior"
               }
           },           

            "processing": true,
            "serverSide": true,
            "ajax": "{{route('inventarios.listatable')}}",
            "columns": [
                { "data": "id", "visible":true, className: "idinventario" },               
                { "data": "codigo", "orderable":false, className: "text-center inventario priority-1" },
                { "data": "nombre", className: "nombre inventario" },
                { "data": "Consentracion", className: "Consentracion inventario", "width": "5%"},
                { "data": "fabricante", className: "apellidos inventario"},
                { "orderable": false, "data": "stock", className: "text-center inventario"},
                {  "data": "costo","orderable":false, className: "text-center inventario priority-1"},
                { "orderable":false, "data": "precio", className: "text-center inventario priority-1"},
                { "orderable":false, "data": "precioiva", className: "text-center inventario priority-1"},                
                {  "data": "fecha_exp","orderable":false, className: "text-center inventario priority-1"},
                { "orderable": false,"data": "btn", className: "text-center", "width": "15%"},
            ],
            columnDefs: [{      
                     
                "render": function ( data, type, row ) {
                
                  return"$ "+data;
                
                },
                "targets": [6,7,8]
            }],
            "createdRow": function( row, data, dataIndex){              
                 if(data.stock < data.minimo){                  
                   $(row).addClass('red');                  
                   $(row).popover({
                    trigger: 'hover',
                    title: 'Minimo de inventario',                    
                    content:' la cantidad de medicamento esta por debajo del numero requerido',
                    placement: 'top',
                    border: '6px solid blue'
                });
                $(row).popover("toggle");               
                }else{
                  $(row).addClass('blue');
                }
                 
            },

        } );
      
        /* var table = $('#inventario').DataTable();
             table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
              var data = this.data();
                console.log(data.codigo);
              } ); */

        $('#inventario tbody').on('click', '.inventario', function () {         
            var codigo = $(this).siblings('.idinventario').html();                   
            window.location="{{route('inventarios.index')}}"+'/'+codigo;
        } );  

        $('#paquetes').DataTable( {
            language: {
               "decimal": "",
               "emptyTable": "No hay información",
               "info": "Mostrando _START_ a _END_ de _TOTAL_  Medicamentos",
               "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
               "infoFiltered": "(Filtrado de _MAX_  total  Medicamentos)",
               "infoPostFix": "",
               "thousands": ",",
               "lengthMenu": "Mostrar _MENU_  Medicamentos",
               "loadingRecords": "Cargando...",
               "processing": "Procesando...",
               "search": "Buscar:",              
               "zeroRecords": "Sin resultados encontrados",
               "deferRender": true,
               "paginate": {
                   "first": "Primero",
                   "last": "Ultimo",
                   "next": "Siguiente",
                   "previous": "Anterior"
               }
           },           

            "processing": true,
            "serverSide": true,
            "ajax": "{{route('inventarios.tablapaquetes')}}",
            "columns": [
                { "data": "id", "visible":true, className: "idpaque"},               
                { "data": "nombre", className: "nombre paque"},               
                {  "data": "costo","orderable":false, className: "text-center paque priority-1"},
                { "orderable":false, "data": "precio", className: "text-center paque priority-1"},               
                { "orderable": false,"data": "btn", className: "text-center" }
            ],
            columnDefs: [{             
                "render": function ( data, type, row ) {
                
                  return"$ "+data;
                
                },
                "targets": [2,3]
            }],
            /* columnDefs: [{             
                "render": function ( data, type, row ) {
                
                  return"$ "+data;
                
                },
                "targets": [5,6,7,8]
            }], */
          /*   "createdRow": function( row, data, dataIndex){
                 if(data.stock < 3){                  
                   $(row).addClass('red');                  
                   $(row).popover({
                    trigger: 'hover',
                    title: 'Minimo de inventario',                    
                    content:' la cantidad de medicamento esta bajo el minimo requerido',
                    placement: 'top',
                    border: '6px solid blue'
                });
                $(row).popover("toggle");               
                }else{
                  $(row).addClass('blue');
                }
                 
            }, */

        } );  
       
    });

    $(document).on("click", "#paquetes tbody .paque", function() {
      var codigo = $(this).siblings('.idpaque').html();          
       $('#idcomb').val(codigo);
       $('#showcombo').submit();
    });   

    function seleccion(){
     var dato = $('#selector').val();
     if(dato == 1){
       document.getElementById('tablamedicamentos').style.display = "block";
       document.getElementById('tablapaquetes').style.display = "none";
     }else{
      document.getElementById('tablamedicamentos').style.display = "none";
       document.getElementById('tablapaquetes').style.display = "block";
     }
     $('#selector').blur()
    }

    function editarpaquete(valor){
      var idd = valor;     
      $.ajax({
          url: '{{ route("inventarios.comboaeditar")}}',
          type: 'GET',
          data:{'idd':idd, '_token': '{{ csrf_token() }}'},
          success:function(response)
          {           
            $('#nombrepaqueteeditar').val(response.nombre);
            $('#preciopaquete').val(response.precio);
            $('#costopaquete').val(response.costo);       
            }, 
          error: function(request, status, error){
            console.log(request.responseText);

          }
        });       
        $("#modaleditarpaquete").modal("show");              
       $("#idpaqueteditar").val(valor);
    }

    function deletepaquete(idcombo){
     $('#deletecomboid').val(idcombo);
     $('#deletecomboform').submit();
    }

    function test(valor){              
       $("#agregarstock").modal("show");        
       $("#medicamento_id").val(valor);
      }
    function editar(valor){
      var idd = valor;
      $.ajax({
          url: '{{ route("inventarios.medicamentoaeditar")}}',
          type: 'GET',
          data:{'idd':idd, '_token': '{{ csrf_token() }}'},
          success:function(response)
          {          
              $("#editarmedicamento").modal("show");     
              $("#medicamento_idedit").val(valor);
              $("#codigoedit").val(response.codigo);
              $("#nombreedit").val(response.nombre);
              $('#minimoedit').val(response.minimo);   
              $("#concentracionedit").val(response.consentracion);   
              $("#fabricanteedit").val(response.fabricante);   
              $("#stockedit").val(response.stock);   
              $("#costoedit").val(response.costo);   
              $("#precioedit").val(response.precio);   
              $("#fechaexp1edit").val(response.expiracion);                          
            }                
        });             
            
    } 

    function enviarpaqueteaeditar(){
      $('#editarpaquete').submit();
    } 
    
    function editarmed(){    
      var precio = $('#precioedit').val();
      var precioiva = precio * 1.13;
      precioiva = precioiva.toFixed(2);
      $('#precioivaedit').val(precioiva);
      $('#editmedicamento').submit();
    }

    function deletetargett(dato){
        $('#idaborrar').val(dato);
        Swal.fire({
                  position:'center',
                  icon: 'warning',
                  title: 'Desea eliminar el Medicamento?',
                  showConfirmButton: true,                
            }).then((result) => {
                      $('#deleteform').submit();
            });
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
    function envio(){
     var  cod = $('#codigomedicamento').val();
       if(cod != ""){
        document.getElementById('codigomedicamento').classList.remove("is-invalid"); 
          var nombre = $('#nombremedicamento').val();
        if(nombre != ""){
          document.getElementById('nombremedicamento').classList.remove("is-invalid"); 
            var concentracionp = $('#nombremedicamento').val();
          if(concentracionp != ""){
            document.getElementById('concentracionc').classList.remove("is-invalid"); 
              var fabri = $('#fabricantemedicamento').val();
            if(fabri != ""){
              document.getElementById('fabricantemedicamento').classList.remove("is-invalid"); 
                  var tock = $('#stock').val();
              if(tock != ""){
                document.getElementById('stock').classList.remove("is-invalid"); 
                       var coss = $('#costo').val();
                  if(coss != ""){
                    document.getElementById('costo').classList.remove("is-invalid"); 
                           var precioinput = $('#precio').val();
                      if(precioinput != ""){
                        document.getElementById('precio').classList.remove("is-invalid"); 
                               var fechaexpp = $('#fechaexp').val();                               
                          if(fechaexpp != ""){
                              var dato = moment(fechaexpp);                        
                              var now = moment();
                              var compare = moment(dato).isAfter(now);
                              if(compare == true){
                                  document.getElementById('fechaexp').classList.remove("is-invalid"); 
                                  var numero = $('#concentracionc').val();
                                  var medida = $('#concentracionm').val();
                                  var concentracion = numero+" "+medida;
                                  document.getElementById('concentracion').value = concentracion; 
                                  var porcentaje = $('#precio').val();        
                                  var porreal = porcentaje /100; 
                                  if(porreal == 1){
                                      document.getElementById('precio').focus;
                                      document.getElementById('precio').classList.add("is-invalid");
                                      document.getElementById('precio').value = "";
                                      Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Porcentaje no valido',
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                  }else{
                                  var costo = $('#costo').val();  
                                  var precio = costo/(1-porreal);
                                  var precioreal = precio.toFixed(2);
                                  if(precioreal <0){
                                    precioreal = precioreal*-1;
                                  }                                 
                                  document.getElementById('precio').value = precioreal;
                                  var poriva = precioreal*1.13;
                                  var porivareal = poriva.toFixed(2);
                                  document.getElementById('precioiva').value = porivareal;                                                                                        
                                  $('#addmedicamento').submit();
                                }
                              }else{
                                document.getElementById('fechaexp').focus();
                                document.getElementById('fechaexp').classList.add("is-invalid"); 
                              }
                          }else{
                            document.getElementById('fechaexp').focus();
                            document.getElementById('fechaexp').classList.add("is-invalid"); 
                          }
                      }else{
                        document.getElementById('precio').focus();
                        document.getElementById('precio').classList.add("is-invalid"); 
                      }     
                  }else{
                    document.getElementById('costo').focus();
                    document.getElementById('costo').classList.add("is-invalid"); 
                  }
              }else{
                document.getElementById('stock').focus();
                document.getElementById('stock').classList.add("is-invalid"); 
              }    
            }else{
              document.getElementById('fabricantemedicamento').focus();
              document.getElementById('fabricantemedicamento').classList.add("is-invalid"); 
            }
          }else{
            document.getElementById('concentracionc').focus();
            document.getElementById('concentracionc').classList.add("is-invalid"); 
          }
        }else{
          document.getElementById('nombremedicamento').focus();
          document.getElementById('nombremedicamento').classList.add("is-invalid"); 
        }
       }else{
         document.getElementById('codigomedicamento').focus();
         document.getElementById('codigomedicamento').classList.add("is-invalid"); 
       }
      }
  </script>
@endsection