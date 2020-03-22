@extends('theme.lte.layout')
@section('styles')
    <!-- Dropzone -->
    <link rel="stylesheet" href="{{asset("dropzone/dropzone.css")}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">
    <style>
        p {
            margin: 0px;
        }
        .card-body{
            position: relative;
        }
        .dropzone{
            background-image: url("{{ asset('assets/img/upload_photos.png')  }}");
            background-repeat: no-repeat;
            background-size:100px;
            background-position: 95%;
            min-height: 400px;
        }
        #my-awesome-dropzone input{
            vertical-align: bottom;
        }
    </style>
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-sm-12" id="main">

            <div class="card mt-2 card-primary">
                <div class="card-header text-center">
                    <h3 class="card-title">Reporte de Procedimiento de {{ $procedimiento->procedimiento_nombre }}</h3>

                </div>
                <div class="card-body">
                    @if(Auth::user()->doctor_id == 16)
                    <div class="row">
                        <div class="col-md-1 col-sm-4">
                            <label for="doctorvisitante">Doctor:</label>
                        </div>
                        <div class="col-md-11 col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="doctorinvitado" id="doctorvisitante" required autocomplete="doctorvisitante" autofocus placeholder="Nombre del doctor">
                                <span class="invalid-feedback" role="alert" id="errorsito" style="display:none">
                                    <strong>¡El campo es requerido!</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-5">
                                <label>Nombre: </label> {{ $paciente->nombre }}
                        </div>
                        <div class="col-md-2">
                                <label>Edad: </label> {{$paciente->edad}}
                        </div>
                        <div class="col-md-2">
                                <label>Genero: </label> {{$paciente->sexo}}
                        </div>
                        <div class="col-md-3">
                                <label>codigo: </label> {{$paciente->codigo}}
                        </div>
                    </div>
                        <div class="row mb-2">
                            <div class="col-sm-5">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label for="precio">Precio del Procedimiento: </label>
                                            <input type="text" class="form-control" id="precio" name="precio" placeholder="$0.00" value="35.00">
                                        </div>

                                    </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-inline">
                                    <div class="form-group" id="main">
                                        <label for="precio" v-show="biopsia">Precio de biopsia: </label>
                                        <input type="text" v-show="biopsia" class="form-control" id="preciob" name="preciob" placeholder="$0.00" value="25.00">
                                        <button class="btn btn-info" v-show="biopsia==false" v-on:click="biopsia=1">Biopsia</button>
                                        <button class="btn btn-info" v-show="biopsia"  v-on:click="biopsia=false">X</button>
                                    </div>
                                </div>

                                <div id="respuesta" class="pull-right text-danger"></div>
                            </div>
                        </div>
                        
                        @if(Auth::user()->doctor_id == 12 && $plantilla==84)
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" name="expediente" id="expediente_paciente" placeholder="Numero de expediente">
                                            </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                            <input type="text" class="form-control form-control-sm" name="equipo" id="equipo" placeholder="Equipo">
                                           </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="diagnostico_clinico" id="diagnostico_clinico" placeholder="Diagnóstico clínico">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="anestesiologo" id="anestesiologo" placeholder="Anestesiologo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="procedencia" id="procedencia_paciente" placeholder="Procedencia">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="intervencion" id="intervencion" placeholder="Intervención">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="anestesia" id="anestesia" placeholder="anestesia">
                                </div>
                                </div>
                            </div>
                        @endif


                        <div class="row mt-1">
                            <div class="col-sm-6">
                                    <form action="{{ route('procedimiento.dropzone', [$procedimiento->id, $plantilla, $paciente->id]) }}" id="my-awesome-dropzone" class="dropzone" enctype="multipart/form-data" method="POST"
                                    data-toggle="popover" data-trigger="hover" title="Fotos para el reporte" data-content="Debe seleccionar sus capturas para el reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        @csrf
                                        {{-- <input type="hidden" name="reporte_id" value="{{$id}}"> --}}
                                        <!-- Now setup your input fields -->
                                    </form>
                                    <div class="row mt-1">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripciones" id="text1" placeholder="descripcion 1" 
                                            @isset($cod[0])
                                                value="{{$cod[0]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text2" placeholder="descripcion 2"
                                            @isset($cod[1])
                                                value="{{$cod[1]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text3" placeholder="descripcion 3"
                                            @isset($cod[2])
                                                value="{{$cod[2]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text4" placeholder="descripcion 4"
                                            @isset($cod[3])
                                                value="{{$cod[3]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text5" placeholder="descripcion 5"
                                            @isset($cod[4])
                                                value="{{$cod[4]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text6" placeholder="descripcion 6"
                                            @isset($cod[5])
                                                value="{{$cod[5]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text7" placeholder="descripcion 7"
                                            @isset($cod[7])
                                                value="{{$cod[7]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text8" placeholder="descripcion 8"
                                            @isset($cod[8])
                                                value="{{$cod[8]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm descripcion" id="text9" placeholder="descripcion 9"
                                            @isset($cod[9])
                                                value="{{$cod[9]}}"
                                            @endisset
                                            data-toggle="popover" data-trigger="hover" title="Descripciones" data-content="Puede agregar pequeñas descripciones para cada una de las capturas en su reporte de {{ $procedimiento->procedimiento_nombre }}">
                                        </div>
                                        
                                    </div>


                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3" id="contenido-reporte" data-toggle="popover" data-trigger="hover" title="Contenido del reporte" data-content="Para su reporte de {{ $procedimiento->procedimiento_nombre }} debe agregar un contenido">
                                    <textarea id="contenido" required class="textarea" placeholder="Contenido..."
                                        style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        @if (isset($historial))
                                            {{ $historial->contenido }}
                                        @else
                                            <b>REPORTE </b>Previo consentimiento de  los padres quienes manifiestan aceptar el procedimiento.
                                            <br><b>SIGNOS VITALES</b>: Oxigeno por bigotera, y monitoreo de signos vitales, Monitoreo  EKG, FC, FR, Saturación Oxigeno.
                                            Se recomendó preparación para colonoscopia con Picosulfato sódico/oxido de magnesio/ácido cítrico anhidro. Exámenes preoperatorios normales.
                                            <br><b>ANESTESIA</b>: Se  realiza procedimiento  Bajo  Sedoanalgesia con Propofol, y Fentanyl,   previa inducción anestésica CON Sevorane 1%, se realiza procedimiento con equipo Olympus  Actera  PCF 100 /9.2 mm/ 2.8 mm.<br><b>Procedimiento</b>: Después de colocar paciente en decúbito dorsal, se introduce endoscopio, a través de orifico anal. <br><b>HALLAZGOS: ANO</b> con mucosa edematosa, no hay fisuras, Se observan fisuras múltiples, y una fisura superficial, no sangrante, localizada a las 12 MD en sentido de las agujas del reloj, Hay aumento de paquetes varicosos perianales grado1-2 , que corresponden a hemorroides externas. <b>RECTO DISTAL </b>con mucosa normal. <b>COLON SIGMOIDES</b>: Mucosa redundante,. Hay vascularidad .No hay erosiones, ni ulceras, no se observan pólipos, se continua avanzando hasta <b>COLON DESCENDENTE</b>: Se observa mucosa normal, patrón vascular normal , sin presencia de erosiones, úlceras, ni pólipos, hasta llegar a flexura esplénica, se continua avanzando hasta <b>COLON TRANSVERSO </b>Donde se observa patrón haustral normal, mucosa normal, sin anormalidades , llegando a flexura hepática <b>COLON ASCENDENDENTE </b>: Mucosa normal, no anormalidades se alcanza área de <b></b>CIEGO<b></b>  observando correa cecal, y orificio de válvula ileocecal, la cual no se cánula. <br><b>Diagnóstico Endoscópico:  HEMORROIDES EXTERNA g1-1/ Fisura anal Superficial No sangrante. RESTO DE COLONOSCOPIA SIN ANORMALIDADES.</b>
                                        @endif
                                    </textarea>
                                </div>
                                <button type="btn" id="btndrop" class="btn btn-primary pull-right btn-block">Generar reporte</button>
                            </div>
                        </div>


                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
    <script>
    $(function () {
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5({
            toolbar: { fa: true,
                "image" : false,
                "link" : false,
                "font-styles" : false,
            },
            useLineBreaks : true,
        });
    });
    $(function(){
        $("#my-awesome-dropzone").popover({
            container: 'body',
            trigger: 'hover'
        });
        $(".descripcion").popover({
            container: 'body',
            trigger: 'hover'
        });
        $("#contenido-reporte").popover({
            container: 'body',
            trigger: 'hover'
        })
    });
    </script>
    <script src="{{asset("dropzone/dropzone.js")}}"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            timeout: 120000,
            uploadMultiple: true,
            parallelUploads: 9,
            maxFiles: 9,
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg,image/png',
            /* params: {
                hallazgos : $("#hallazgos").val(),
                diagnostico : $("#diagnostico").val()
            }, */

            // The setting up of the dropzone
            init: function() {
            var myDropzone = this;
            var url = "{{route('procedimiento.index')}}";
            var urlPaciente = "{{ route('pacientes.show', $paciente->id) }}";


            // First change the button to actually tell Dropzone to process the queue.
            /* this.element.querySelector("button[type=submit]").addEventListener("click", function(e) { */
            document.querySelector("#btndrop").addEventListener("click", function(e) {
                 @if(Auth::user()->doctor_id == 16)
                if($("#doctorvisitante").val().length>0){
                    if (myDropzone.getQueuedFiles().length > 3){
                        if ($("#contenido").val().length>0){
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();
                            //$("#repuesta").html("¡success!");
                        } else {
                            $("#respuesta").html("¡faltan campos requeridos!");
                        }
                    } else {
                        $("#respuesta").html("¡se necesitan mas de 4 capturas!");
                    }
                }
                else{
                    $("#errorsito").show();
                    $("#doctorvisitante").addClass("is-invalid");
                    $("#doctorvisitante").focus();
                    $("doctorvisitante").prop('required',true);
                }
                @else
                    if (myDropzone.getQueuedFiles().length > 3){
                        if ($("#contenido").val().length>0){
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();
                            //$("#repuesta").html("¡success!");
                        } else {
                            $("#respuesta").html("¡faltan campos requeridos!");
                        }
                    } else {
                        $("#respuesta").html("¡se necesitan mas de 4 capturas!");
                    }
                @endif
                // Make sure that the form isn't actually being sent.
                /*if (myDropzone.getQueuedFiles().length > 3){
                    if ($("#contenido").val().length>0){
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                        //$("#repuesta").html("¡success!");
                    } else {
                        $("#respuesta").html("¡faltan campos requeridos!");
                    }
                } else {
                    $("#respuesta").html("¡se necesitan mas de 4 capturas!");
                }*/

            });

            this.on("sending", function(file, xhr, formData){
                formData.append("contenido", $("#contenido").val());
                formData.append("text1",$("#text1").val());
                formData.append("text2",$("#text2").val());
                formData.append("text3",$("#text3").val());
                formData.append("text4",$("#text4").val());
                formData.append("text5",$("#text5").val());
                formData.append("text6",$("#text6").val());
                formData.append("text7",$("#text7").val());
                formData.append("text8",$("#text8").val());
                formData.append("text9",$("#text9").val());
                formData.append('precio',$('#precio').val());
                 @if(Auth::user()->doctor_id == 12 && $plantilla==84)
                    formData.append("expediente",$("#expediente_paciente").val());
                    formData.append("equipo",$("#equipo").val());
                    formData.append("diagnostico_clinico",$("#diagnostico_clinico").val());
                    formData.append("anestesiologo",$("#anestesiologo").val());
                    formData.append("procedencia",$("#procedencia_paciente").val());
                    formData.append("intervencion",$("#intervencion").val());
                    formData.append("anestesia",$("#anestesia").val());
                 @endif
                @if(Auth::user()->doctor_id == 16)
                formData.append('doctorinvitado', $('#doctorvisitante').val());
                @endif
                if ($('#preciob').css('display')=='none'){
                    formData.append('preciob','');
                } else {
                    formData.append('preciob',$('#preciob').val());
                }
            });
            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {
                // Gets triggered when the form is actually being sent.
                // Hide the success button or the complete form.
            });
            this.on("successmultiple", function(files, response) {
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                //$("#respuesta").html(response);
                window.open(url+'/'+response, '_blank');
                window.location.href=urlPaciente;

            });
            this.on("errormultiple", function(files, response) {
                //$("#respuesta").html(response);
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
            });
            }
        }

    </script>
@endsection
