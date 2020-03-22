@extends('theme.lte.layout')
@section('contenido')
@include('pacientes.Notificaciones.notificacionHistorial')
<form action="{{route('doctores.store')}}" method="POST" enctype="multipart/form-data" id="infoDoctor" >
    @csrf
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="text-uppercase" style="font-family:sans-serif">NUEVO DOCTOR PARA:  {{$user->name}}</h5>
            </div>
            <div class="card-body" >
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="nombreDoctor" placeholder="Nombre del doctor">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="apellidosDoctor" placeholder="Apellidos del doctor">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="sexo" placeholder="Sexo">
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="codigoDoctor" placeholder="codigo del doctor">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="tituloDoctor" placeholder="Título del doctor">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="direccion" placeholder="Dirección ">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="cel" placeholder="Télefono del doctor">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="date" class="form-control" name="nacimiento" placeholder="fecha de nacimiento">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file" required onchange="showPreview()">
                            <label class="custom-file-label" id="labelName" name="file" for="customFile" >Seleccionar Archivo</label>
                        </div>
                        <img src="" width="200" height="200" alt="" id="prueba" class="img-thumbnail"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button class="btn btn-primary" name="uno" type="button" onclick="compressAndUpload(this.form.file.value)">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="{{asset('js/axios.js')}}"></script>
<script src="{{asset('js/toastr.js')}}"></script>
<script>
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

    function dataURItoBlob(dataURI) {
        var byteString;
        if (dataURI.split(',')[0].indexOf('base64') >= 0)
            byteString = atob(dataURI.split(',')[1]);
        else
            byteString = unescape(dataURI.split(',')[1]);

        // separate out the mime component
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

        // write the bytes of the string to a typed array
        var ia = new Uint8Array(byteString.length);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        return new Blob([ia], {type:mimeString});
    }

    function compress (source_img_obj, quality, output_format){

        var mime_type = "image/jpeg";
        if(typeof output_format !== "undefined" && output_format=="png"){
            mime_type = "image/png";
        }


        var cvs = document.createElement('canvas');
        cvs.width = source_img_obj.naturalWidth;
        cvs.height = source_img_obj.naturalHeight;
        var ctx = cvs.getContext("2d").drawImage(source_img_obj, 0, 0);
        var newImageData = cvs.toDataURL(mime_type, quality/100);
        var result_image_obj = new Image();
        result_image_obj.src = newImageData;
        return result_image_obj;
    }


    function compressAndUpload(archivo) {
        extensiones =['.jpg','.jpeg','.png'];
        extensionesDos =['.doc','.xls','.pdf'];
        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

        for (var i = 0; i < extensiones.length; i++) {
            if (extensiones[i] == extension) {
                var formAdjuntos = $('#infoDoctor');

                src_img = document.getElementById("prueba");
                target_img = document.createElement("IMG");
                target_img.src = compress(src_img,50,'jpg').src;

                blob = dataURItoBlob(target_img.src);
                blob.filename="demofile.png";

                var formData = new FormData();
                peticion = new XMLHttpRequest();
                formData.append('file', blob,"demofile.png".replace(/\.[^/.]+$/, ".png"));
                url= formAdjuntos.attr('action') + '?' + formAdjuntos.serialize();
                method = formAdjuntos.attr('method');
                peticion.open(method,url);
                peticion.send(formData);



            }else{
                for (var i = 0; i < extensionesDos.length; i++) {
                    if (extensionesDos[i] == extension) {
                        var formAdjuntos = $('#infoDoctor');
                        var formData = new FormData();
                        var file = document.getElementById('file').files[0];
                        peticion = new XMLHttpRequest();
                        formData.append('file', file);
                        url= formAdjuntos.attr('action') + '?' + formAdjuntos.serialize();
                        method = formAdjuntos.attr('method');
                        peticion.open(method,url);
                        peticion.send(formData);


                        peticion.onreadystatechange = function() {
                            if (this.status >= 400) {
                                    var formAdjuntos = $('#infoDoctor');
                                    $('#createdoctor').modal('hide');
                                    formAdjuntos.reset();
                                    alert('intentelo de nuevo');
                            }
                        }
                    }
                }
            }
        }
    }
</script>
@endsection

