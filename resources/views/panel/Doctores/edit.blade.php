@extends('theme.lte.layout')
@section('contenido')
   {{--  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-uppercase" style="font-family:sans-serif">Elegir clinica para {{$doctor->tituloDoctor}}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('doctores.clinica')}}" method="POST" >
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                            <input type="hidden" name="varclinica" value="@if(!empty($idclinica)){{$idclinica->id}}@endif">
                                <select id="clinica" class="form-control @error('clinica') is-invalid @enderror" name="clinica"   autocomplete="clinica" onchange="this.form.submit()">
                                    <option value="">Seleccione...</option>
                                    @foreach ($clinicas as $clinica)
                                    <option value="{{$clinica->id}}" @if(!empty($idclinica))@if($idclinica->clinica_id==$clinica->id) echo selected @endif @endif>{{$clinica->nombreClinica}}</option>
                                    @endforeach
                                </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-uppercase" style="font-family:sans-serif">editar doctor</h5>
                    </div>
                    <form id="editDoctor" action="{{ route('doctores.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="nombreDoctor">Nombre:</label>
                                        <input type="text" class="form-control" name="nombreDoctor" value="{{ $doctor->nombreDoctor }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Apellidos:</label>
                                        <input type="text" class="form-control" name="apellidosDoctor" value="{{ $doctor->apellidosDoctor }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Título:</label>
                                        <input type="text" class="form-control" name="tituloDoctor" value="{{ $doctor->tituloDoctor }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Teléfono:</label>
                                        <input type="text" class="form-control" name="cel" value="{{ $doctor->cel}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Dirección:</label>
                                        <input type="text" class="form-control" name="direccion" value="{{ $doctor->direccion }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Código:</label>
                                        <input type="text" class="form-control" name="codigoDoctor" value="{{ $doctor->codigoDoctor }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nacimiento:</label>
                                        <input type="date" class="form-control" name="nacimiento" value="{{ $doctor->nacimiento}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">sexo:</label>
                                        <input type="text" class="form-control" name="sexo" value="{{ $doctor->sexo }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-control">
                                        <input type="file" name="logo" id="logo" required onchange="preview()">
                                        <img src="{{asset('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/'.$doctor->logo)}}" height="200" width="200" class="rounded"  alt="" id="logoImg" >
                                    </div>
                                    <label for="logo">Marca de agua del doctor:</label>
                                    <div class="form-control">
                                        <input type="file" name="makerwater" id="marcaAgua" onchange="marcapreview()">
                                        <img src="{{asset('/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor.'/logo2.png')}}" height="200" width="200" alt="" class="rounded" id="marca">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{route('doctores.index')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="button" class="btn btn-primary" onclick="compressAndUpload()">Actualizar</button>
                        </div>
                    </form>
                </div>
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
        var formAdjuntos = $('#editDoctor');

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
                toastr.success('las imagenes se subieron correctamente');
            }
        }
        request.addEventListener("load", reqListener);
        request.open(method,url);
        request.send(formdata);
    }
</script>
@endsection

