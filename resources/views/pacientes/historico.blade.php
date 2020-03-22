@extends('theme.lte.layout')
@section('styles')
<link href="{{asset('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{asset("assets/plugins/font-awesome/css/font-awesome.min.css")}}">
<style type="text/css">
    .main-section{
        margin:0 auto;
        padding: 20px;
        margin-top: 100px;
        background-color: #fff;
        box-shadow: 0px 0px 20px #c1c1c1;
    }
    .img-pointer{
        cursor: pointer;      
    },
    .fileinput-upload{
        display: none;
    }
    .badge{
        cursor: pointer;
        margin-left: 5px;
        font-size: 15px;
        font-weight: normal;
    },
    

</style>
@endsection
@section('contenido')
<section class="content row justify-content-center">
    <div class="col-md-12 col-xl-11 col-sm-12">
            @if (Session::has('exito'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                {{Session::get('exito')}}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12">
                <div class="card card-primary card-outline">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-lg-3 col-md-2 col-sm-3" style="">
                                <a href="{{route('pacientes.show',$paciente->id)}}" class="btn btn-sm btn-primary"> <i class="fa fa-user" aria-hidden="true"></i> Perfil paciente</a>
                            </div>
                            <div class="col-lg-9 col-md-10 col-sm-9 text-right"><h3>Historial clínico</h3></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-pane active" id="Historial">
                            <ul class="timeline timeline-inverse">
                                @foreach ($historicos as $item)
                                <li class="time-label ">
                                    <span class="bg-info">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y - h:i a')}}
                                    </span>
                                </li>
                                <li>
                                    <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                                        <div class=" timeline-header " style="color:#000;font-family:Verdana, Geneva, Tahoma, sans-serif">
                                            @if($item->mejora != null)<p>El paciente {{$item->mejora}}</p>@else Detalles de paciente @endif
                                        </div>
                                        <div class="timeline-body">
                                            @if($item->peso != null)<p><b>Peso:</b> {{$item->peso}}</p>@endif
                                            @if($item->presion != null)<p><b>Presión:</b> {{$item->presion}}</p>@endif
                                            @if($item->temperatura != null)<p><b>Temperatura:</b> {{$item->temperatura}}</p>@endif
                                            @if($item->glucosa != null)<p><b>Glucosa:</b> {{$item->glucosa}}</p>@endif
                                            @if($item->estatura != null)<p><b>Estatura:</b> {{$item->estatura}}</p>@endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
@section('scripts')
<script>
    function mostrardatos(){
        $('#limostrar').hide();
        $(".masdatos").show();
    }
    
    $(document).ready(function() {

        $("#siposee").click(function() {  
            document.getElementById('asegurados').style.display = "block";
            document.getElementById('companiaseguro').value = "{{$paciente->companiaseguro}}";
            document.getElementById('nopoliza').value = "{{$paciente->nopoliza}}";
            document.getElementById('nocarnet').value = "{{$paciente->nocarnet}}";
        });

        $("#noposee").click(function() {  
            document.getElementById('asegurados').style.display = "none";
            document.getElementById('companiaseguro').value = "";
            document.getElementById('nopoliza').value = "";
            document.getElementById('nocarnet').value = "";
        });

    });

    toastr.options = {
        "positionClass": "toast-bottom-right",
    }

@if(Session::has('info'))
    @if(Session::get('info') == 'El archivo ha sido eliminado correctamente!')
         
        toastr.success('Se elimino el archivo correctamente');
    @elseif(Session::get('info') == 'La receta se eliminó correctamente')
            $('a[href="#recetas"]').click();
            toastr.success('La receta se elimino correctamente');
    @elseif(Session::get('info') == 'El adjunto se subio correctamente')
        $('a[href="#adjuntos"]').click();
        toastr.success('el archivo se subio con exito');
    @elseif(Session::get('info') == 'ok')
        toastr.success('La foto de perfil se cambio con exito');
    @elseif(Session::get('info') == 'receta exito')
        $('a[href="#recetas"]').click();
    @elseif(Session::get('info') == '¡La consulta ha sido eliminada!')
        toastr.success('Se ha eliminado la consulta');
    @endif
@endif

//para el textarea
$(function () {
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5({
            toolbar: { fa: true,
                "image" : false,
                "link" : false,
                "font-styles" : false,
            },
            useLineBreaks : true,
        })
    })

//comfirmar para eliminar un paciente
    $('#formDelete').on('submit', function(e){
        if(!confirm('Desea eliminar al paciente?')){
            e.preventDefault();
        }
    });
//para formulario de receta
    $('#formReceta').on()
//ara formulario de adjuntos
   /*  $('#file-3').fileinput({
        theme: 'fa',
        maxFileSize:5000,
        overwriteInitial: false,
        maxFilesNum: 1,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    }); */
//para formularios de procedimientos
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
    $(document).ready(function(){
        $('.eliminarProcedimientoBtn').click(function(){
            if (confirm('Desea eliminar el procedimiento')){
                $(this).siblings('form').submit();
            }
        });
    });

    $(document).ready(function(){
        $('.deleteconsulta').click(function(){
            if (confirm('¿Desea eliminar la consulta?')){
                $(this).siblings('form').submit();
            }
        });
    });


    function showPreview(){
        file = document.getElementById('file').files[0];
        preview = document.getElementById('prueba');
        label = document.getElementById('labelName');
        name = document.getElementById('file').files[0].name;

        reader = new FileReader();

        reader.addEventListener("load", function() {
            preview.src = reader.result;
        },false);

        reader.readAsDataURL(file);
        label.innerHTML = name;
    }


    function compressAndUpload(archivo) {
        extensiones =['.png','.jpg','.jpeg','.gif'];
        extensionesDos =['.doc','.xls','.xlsx','.pdf'];
        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

        for (var i = 0; i < extensiones.length; i++) {
            if (extensiones[i] == extension) {
                var formAdjuntos = $('#adjuntoss');
                var inputFile = $('#file');

                src_img = document.getElementById("prueba");
                target_img = document.createElement("IMG");
                target_img.src = compress(src_img,25,'jpg').src;

                blob = dataURItoBlob(target_img.src);
                blob.filename="demofile.png";

                var formData = new FormData();
                peticion = new XMLHttpRequest();
                peticion.upload.addEventListener("progress", function(e){
                    var barra = document.getElementById("barraProgreso");
                    var oculto =  document.getElementById("progreso");
                    oculto.style.display = "block";
                    var p = Math.round((e.loaded/e.total)*100);
                    barra.style.width = p + '%';
                    barra.innerHTML = p + "%";
                });
                formData.append('file', blob,"demofile.png".replace(/\.[^/.]+$/, ".jpg"));
                url= formAdjuntos.attr('action') + '?' + formAdjuntos.serialize();
                method = formAdjuntos.attr('method');
                peticion.open(method,url);
                peticion.send(formData);

                peticion.onreadystatechange = function() {
                    if (this.readyState == 4){
                        if (this.status == 200) {
                            var array = JSON.parse(this.responseText);
                            if(array["resultado"] == "1")
                            {
                                window.location = "{{route('adjuntos.mensajes', $paciente->id)}}";
                            }else if(array["resultado"] == "algo salio mal")
                            {
                                $('#adjuntos').modal('hide');
                                document.getElementById("adjuntoss").reset();
                                toastr.danger('fallo');
                            }
                        }else if (this.status >= 400) {
                            $('#adjuntos').modal('hide');
                            document.getElementById("adjuntoss").reset();
                            alert('intentelo de nuevo');
                        }
                    }
                }
            }
        }

        for (var i = 0; i < extensionesDos.length; i++) {
            if (extensionesDos[i] == extension) {
                var formAdjuntos = $('#adjuntoss');
                var formData = new FormData();
                var file = document.getElementById('file').files[0];
                peticion = new XMLHttpRequest();
                peticion.upload.addEventListener("progress", function(e){
                    var barra = document.getElementById("barra");
                    barra.style.display = "block";
                    var p = Math.round((e.loaded/e.total)*100);
                    barra.value = p;
                });
                formData.append('file', file);
                url= formAdjuntos.attr('action') + '?' + formAdjuntos.serialize();
                method = formAdjuntos.attr('method');
                peticion.open(method,url);
                peticion.send(formData);

                peticion.onreadystatechange = function() {
                    if (this.readyState == 4){
                        if (this.status == 200) {
                            window.location = "{{route('adjuntos.mensajes', $paciente->id)}}";
                        }else if (this.status >= 400) {
                            $('#adjuntoss').modal('hide');
                            document.getElementById('adjuntoss').reset();
                            alert('intentelo de nuevo');
                        }
                    }
                }
            }
        }
    }
    


   function enviado(){
       formulario = $('#formularioReceta').submit();
        window.location = "{{route('recetas.mensaje', $paciente->id)}}";
   }

   function cambiar(){
        carga = document.getElementById('cargando');
        input = document.getElementById('inputProfile').files[0];
        profile = document.getElementById('avatarProfile');
        avatar = document.getElementById('avatar');
        form1  = $('formperfil');
        reader = new FileReader();
        reader.addEventListener("load", function(){
            avatar.src = reader.result;
        });

        reader.addEventListener("progress", function(){
            carga.style.display = "block";
            profile.style.display = "none";
        });

        reader.readAsDataURL(input);

        reader.onload = function(event) {
            elemento = document.createElement('IMG');
            elemento.src = compress(avatar,15,'jpg').src;
            blob = dataURItoBlob(elemento.src);
            blob.filename="imagen.jpg";

            var formulario  = $('#formProfile');

            formdata = new FormData();
            peticion = new XMLHttpRequest();
            peticion.upload.addEventListener("progress", function(e){
                var barra = document.getElementById("barraProfile");
                var oculto =  document.getElementById("divoculto");
                oculto.style.display = "block";
                var p = Math.round((e.loaded/e.total)*100);
                barra.style.width = p + '%';
                barra.innerHTML = p + "%";
            });
            formdata.append('photo', blob,"imagen.jpg".replace(/\.[^/.]+$/, ".jpg"));
            url = formulario.attr('action') + '?' + formulario.serialize();
            method = formulario.attr('method');
            function reqListener () {
                if(this.responseText == 200)
                {
                    window.location = "{{route('adjuntos.cambioperfil', $paciente->id)}}"
                }
            }
            peticion.addEventListener("load", reqListener);
            peticion.open(method,url);
            peticion.send(formdata);
        };
   }
   
</script>
@endsection