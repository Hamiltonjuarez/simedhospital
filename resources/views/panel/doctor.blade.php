@extends('theme.lte.layout')
@section('styles')
    <style>
        table > tbody > tr {
            cursor: pointer;
        }
        table > tbody > tr:hover{
            background-color: #99ccff;
        }
        .fileinput-upload{
            display: none;
        }
    </style>
@endsection
@section('contenido')

    <div class="row justify-content-center">
        <div class="col-xl-11 col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('doctores.create')}}" class="btn btn-primary" >Nuevo doctor</a>
                            <a href="{{ route('doctores.plantilla') }}" class="btn btn-warning ">plantillas</a>
                        </div>
                        <div class="col"><h5 class="text-right text-uppercase">Lista de doctores</h5></div>
                    </div>
                </div>
                <div class="card-body" id="doctores">
                        <div class="table-responsive">
                            <table class="table table-sm text-center" >
                                <thead class="bg-info">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Código</th>
                                        <th >Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-dark">
                                    @foreach ($doctores as $doctor)
                                    <tr>
                                        <td v-on:click="verDoctor('{{$doctor->id}}')">{{$doctor->nombreDoctor}}</td>
                                        <td v-on:click="verDoctor('{{$doctor->id}}')">{{$doctor->apellidosDoctor}}</td>
                                        <td  v-on:click="verDoctor('{{$doctor->id}}')">{{$doctor->codigoDoctor}}</td>
                                        <td width="200px" >
                                            <a href="{{ route('doctores.newasistente', $doctor->id) }}"  class="btn  btn-info"><i class="fa fa-plus" aria-hidden="true">Asistente</i></a>
                                            <a href="{{ route('doctores.edit', $doctor->id) }}" class="btn  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <button class="btn  btn-danger " v-on:click="deleteDoctor()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $doctores->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{asset('js/axios.js')}}"></script>
<script src="{{asset('js/toastr.js')}}"></script>
<script>
    var doctor = new Vue({
        el: '#doctores',
        data: {

        },
        methods: {
            verDoctor: function(doctor)
            {
                window.location.href = "{{route('doctores.index')}}"+'/'+doctor;
            },
            deleteDoctor: function()
            {
                alert("si funciona!");
            }
        }
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
                function reqListener () {
                  window.location = 'newuser/'+this.responseText;
                }
                peticion.addEventListener("load", reqListener);
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
