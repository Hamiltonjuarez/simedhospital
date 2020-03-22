@extends('theme.lte.layout')
@section('styles')
<link href="{{asset('css/select.css')}}" rel="stylesheet"/> 
<style type="text/css">
   
    .img-pointer{
        cursor: pointer;      
    }, 
    .selectborder{
        background: black ;
        color: #000;
        width: 3px;
        border: solid 2px black;
    }    
    .mensaje{
        color: blue;
        text-decoration: underline;
    } 
    .quitarunderline{
        text-decoration: none;
        color: red;
    }
    .editable{
        border: solid black 1px;
        border-radius: 10px;
        width:100%;
        height:auto;
        min-height: 170px;
       /*  overflow:auto; */
        padding-left:10px;
    }
    
    .p{
        padding-top:0px;
    }
</style>
@endsection
@section('contenido')

    <div class="container">
        <div class="card">
            <div class="card-header border-primary">
                <div class="row">
                    <div class="col">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevaReceta">Nueva Receta</a>
                    </div>
                    <div class="col">
                        <h5 class="pull-right text-uppercase">
                            Listado de recetas
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($recetas->count()>0)
                    <table class="table table-sm">
                        <thead class="text-uppercase">
                            <tr>
                                <th>Titulo Receta</th>
                                <th >Detalle de receta</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recetas as $receta)
                            <tr>
                                <td>{{$receta->tituloReceta}}</td>
                                <td width="650" >{!!$receta->descripcionReceta!!}</td>
                                <td  class="text-center">
                                    <a href="{{route('imprimirReceta', $receta->id)}}" target="_blank" class="btn btn-sm btn-primary">Imprimir</a>
                                    @if(Auth::user()->hasPermission('delete_recetas'))
                                    <button type="button" class="btn btn-sm btn-danger"
                                    onclick="event.preventDefault();
                                                    document.getElementById('delete-receta').submit();">
                                        {{ __('Eliminar') }}
                                    </button>
                                    <form action="{{route('recetas.destroy',$receta->id)}}" method="POST" id="delete-receta">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$recetas->links()}}
                @endif
            </div>
        </div>
    </div>
    <form action="" id="enviomedicamentos" method="POST">
        @csrf

    </form>

    @include('Recetas.nuevaReceta')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="{{asset('js/select.js')}}"></script>
<script>
 /* $(function () {
          // bootstrap WYSIHTML5 - text editor
         var textare = $('#receta').wysihtml5({
          toolbar: { fa: true },
          useLineBreaks : true,        
          })

          $("#receta").data("wysihtml5").editor.setValue('new content');
      }); */
      document.addEventListener('DOMContentLoaded', (event) => {      
        $('#plantilla1').click(function(){
            $('#receta1').addClass('border border-primary');
            $('#receta2').removeClass('border border-primary');
            $('#receta3').removeClass('border border-primary');
            $('#receta4').removeClass('border border-primary');
        });
        $('#plantilla2').click(function(){
            $('#receta1').removeClass('border border-primary');
            $('#receta2').addClass('border border-primary');
            $('#receta3').removeClass('border border-primary');
            $('#receta4').removeClass('border border-primary');
        });
        $('#plantilla3').click(function(){
            $('#receta1').removeClass('border border-primary');
            $('#receta2').removeClass('border border-primary');
            $('#receta3').addClass('border border-primary');
            $('#receta4').removeClass('border border-primary');
        });
        $('#plantilla5').click(function(){
            $('#receta1').removeClass('border border-primary');
            $('#receta2').removeClass('border border-primary');
            $('#receta3').removeClass('border border-primary');
            $('#receta4').addClass('border border-primary');
        });
    });

    function addmedicamento(){      
        
        var dato = $("#medicamentos option:selected").attr("id");
        var selecion = $('#medicamentos').val();
        var cantidad = $('#cantidad').val();
        var nombre = "b[]";
        if(dato > 0){          
           if(selecion == "paquete"){
               var idd = $("#medicamentos option:selected").attr("id");
                $.ajax({
                    url: '{{ route("recetas.paqueteseleccionado")}}',
                    type: 'GET',
                    data:{'idd':idd, '_token': '{{ csrf_token() }}'},
                    success:function(response)
                    {
                       var dar = {!!$paquetes!!};
                       console.log(dar[0].nombre);      
                       for(f = 0; f<dar.length;f++){
                          if(dar[f].id == idd){
                             var nombcodigo = dar[f].nombre;
                          }
                       }              
                         var combo = $("#medicamentos option:selected");                       
                         var lista = document.createElement('ul');
                    for(i = 0 ; i< response[0].length ; i++){
                        var col = document.createElement('li');
                        col.innerHTML += response[0][i].nombre +"&nbsp;";
                        lista.appendChild(col);
                    }       
                    console.log(lista);
                    var texarea = document.getElementById('receta');
                    texarea.innerHTML += "<b><h4>"+nombcodigo+"</h4></b>"                    
                    texarea.innerHTML += "<b>"+lista.innerHTML+"</b>"+"&nbsp;";             
                     
                    }, 
                    error: function(request, status, error){
                        console.log(request.responseText);

                    }
                });    
           }else{
            if(cantidad > 0){
                var d = dato+"!"+cantidad;
                var formulario = document.getElementById("createreceta");
                var input = document.createElement('input');
                input.name = nombre;
                input.type = "hidden";
                input.value =  d; 
                input.id = d;              
                formulario.appendChild(input);                
                
              
                var text =$('#medicamentos').val();               
                var spa = document.createElement('span');
                spa.innerHTML = "<b>"+cantidad+" "+"Unidades de"+text+"</b>"+"&nbsp;";
                var texarea = document.getElementById('receta');
                texarea.innerHTML += "&nbsp;";
                /* texarea.innerHTML += "<span>"+"<b>"+cantidad+" "+"Unidades de"+text+"</b>"+"</span>"+"&nbsp;";  */
                texarea.innerHTML += spa.innerHTML;        
                texarea.innerHTML += "&nbsp;";               
               
                
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

    function showmodal(){
        document.getElementById('medicamentoscard').style.display ="block";
    }

   function create(){
    var div= document.getElementById("receta").innerHTML;
        console.log(div);
        var leng = div.length;       
        if(leng > 0 ){
            $('#descripcion').val(div);
            $('#createreceta').submit();
        }else{
            alert('$$');
        }
    }

</script>
@endsection
