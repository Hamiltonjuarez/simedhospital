@extends('theme.lte.layout')
@section('contenido')
    <form action="{{route('doctores.upload')}}" method="POST" enctype="multipart/form-data" id="upload" style="display:block">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-uppercase">subir logos para {{$doctor->tituloDoctor}}</h5>
                    </div>
                    <div class="card-body">
                        @include('pacientes.Notificaciones.notificacionHistorial')
                        <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                        <label for="logo">Logo del doctor:</label>
                        <div class="form-control">
                            <input type="file" name="logo" id="logo" required onchange="preview()">
                            <img src="" height="200" width="200" class="img-thumbnail" alt="" id="logoImg" >
                        </div>
                        <label for="logo">Marca de agua del doctor:</label>
                        <div class="form-control">
                            <input type="file" name="makerwater" id="marcaAgua" onchange="marcapreview()">
                            <img src="" height="200" width="200" alt="" class="img-thumbnail" id="marca">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class=" text-center">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="compressAndUpload()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <form action="{{route('clinicas.store')}}" style="display:none"   id="clinica" method="POST">
                    @csrf
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h5 class="text-uppercase" style="font-family:sans-serif">nueva clinica para {{$doctor->tituloDoctor}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="doctor_id" id="doctor_id" value="{{$doctor->id}}">
                                    <div class="form-group">
                                        <label for="clinicaName">Nombre:</label>
                                        <input type="text" name="nombreClinica" id="clinicaName" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaSlogan">Slogan:</label>
                                        <input type="text" name="slogan" id="clinicaSlogan" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaDireccion">Dirección:</label>
                                        <input type="text" name="direccion" id="clinicaDireccion" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaTelefonos">Teléfonos:</label>
                                        <input type="text" name="telefonos" id="clinicaTelefonos" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaCelular">Celular:</label>
                                        <input type="text" name="celular" id="clinicaCelular" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="clinicaFacebook">Facebook:</label>
                                        <input type="text" name="facebook" id="clinicaFacebook" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaInstagram">Instagram</label>
                                        <input type="text" name="instagram" id="clinicaInstagram" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaWeb">Página web:</label>
                                        <input type="text" name="paginaWeb" id="clinicaWeb" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="clinicaEmail">Email:</label>
                                        <input type="text" name="email" id="clinicaEmail" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('js/toastr.js')}}"></script>
    <script>
        function preview()
        {
            file = document.getElementById('logo').files[0];
            vista = document.getElementById('logoImg');

            reader = new FileReader();
            reader.addEventListener("load", function()
            {
                vista.src = reader.result;
            }, false);

            reader.readAsDataURL(file);
        }

        function marcapreview()
        {
            file = document.getElementById('marcaAgua').files[0];
            vista = document.getElementById('marca');

            reader = new FileReader();
            reader.addEventListener("load", function(){
                vista.src = reader.result;
            }, false);

            reader.readAsDataURL(file);
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

    function compressAndUpload()
    {
        var formAdjuntos = $('#upload');
        var formClinica = $('#clinica');

        src_img =document.getElementById('logoImg');
        target_img = document.createElement("IMG");
        target_img.src = compress(src_img, 50 , 'jpg').src;

        blob =dataURItoBlob(target_img.src);
        blob.filename = "demofile.png";

        sourceimg = document.getElementById("marca");
        target = document.createElement("IMG");
        target.src = compress(sourceimg,50,'jpg').src;

        image = dataURItoBlob(target.src);
        image.filename="image.png";

        var formdata = new  FormData();
        formdata.append('logo', blob,"demofile.png".replace(/\.[^/.]+$/, ".png"));
        formdata.append('makerwater', image,"image.png".replace(/\.[^/.]+$/, ".png"));
        var request = new XMLHttpRequest();
        url= formAdjuntos.attr('action') + '?' + formAdjuntos.serialize();
        method = formAdjuntos.attr('method');
        function reqListener () {
            if(this.responseText == 200)
            {
                document.getElementById('upload').reset();
                document.getElementById('upload').style.display = "none";
                toastr.success('las imagenes se subieron correctamente');
                document.getElementById('clinica').style.display = "block";
            }
        }
        request.addEventListener("load", reqListener);
        request.open(method,url);
        request.send(formdata);
    }
    </script>
@endsection
