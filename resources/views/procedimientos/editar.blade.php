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
        .dropzonetoggle{
            display: none;
        }
        #capturas{
            min-height: 400px;
        }
        .dropzone2{
            background-image: url("{{ asset('assets/img/upload_photos.png')  }}");
            background-repeat: no-repeat;
            background-size:100px;
            background-position: 95%;
            min-height: 400px;
            border: solid 1px black;
            padding: 10px;
        }
        .dropzone2 img{
            width: 150px;
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
                                            <input type="text" class="form-control" id="precio" name="precio" placeholder="$0.00" value="{{ $procedimiento->precioProcedimiento }}">
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-inline">
                                    <div class="form-group" id="main">
                                        <label for="precio" v-show="biopsia">Precio de biopsia: </label>
                                        <input type="text" v-show="biopsia" class="form-control" id="preciob" name="preciob" placeholder="$0.00" value="{{ $procedimiento->precioBiopsia }}">
                                        <button class="btn btn-info" v-show="biopsia==false" v-on:click="biopsia=1">Biopsia</button>
                                        <button class="btn btn-info" v-show="biopsia"  v-on:click="biopsia=false">X</button>
                                    </div>
                                </div>
                                
                                <div id="respuesta" class="pull-right text-danger"></div>
                            </div>
                        </div>
                        @if(Auth::user()->doctor_id == 12 && $procedimiento->plantilla ==84)
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expediente_paciente">Expediente:</label>
                                            <input type="text" class="form-control form-control-sm" name="expediente" id="expediente_paciente" value="{{$infoproc->expediente}}">
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="equipo">Equipo:</label>
                                        <input type="text" class="form-control form-control-sm" name="equipo" id="equipo" value="{{$infoproc->equipo}}">
                                       </div>
                                   </div>
                                </div>
                                <div class="form-group">
                                    <label for="diagnostico_clinico">Diagnóstico clínico:</label>
                                    <input type="text" class="form-control form-control-sm" name="diagnostico_clinico" id="diagnostico_clinico" value="{{$infoproc->diagnostico_clinico}}">
                                </div>
                                <div class="form-group">
                                    <label for="anestesiologo">Anestesiólogo:</label>
                                    <input type="text" class="form-control form-control-sm" name="anestesiologo" id="anestesiologo" value="{{$infoproc->anestesiologo}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="procedencia">Procedencia:</label>
                                <input type="text" class="form-control form-control-sm" name="procedencia" id="procedencia_paciente" value="{{$infoproc->procedencia}}">
                            </div>
                            <div class="form-group">
                                <label for="intervencion">Intervención:</label>
                                <input type="text" class="form-control form-control-sm" name="intervencion" id="intervencion" value="{{$infoproc->intervencion}}">
                            </div>
                            <div class="form-group">
                                <label for="anestesia">Anestesia:</label>
                                <input type="text" class="form-control form-control-sm" name="anestesia" id="anestesia" value="{{$infoproc->anestesia}}">
                            </div>
                            </div>
                        </div>
                        @endif
                        
                        
                        <div class="row mt-1" >
                            <div class="col-sm-6">
                                <div id="capturas">
                                        @if(count($img)==6)
                                        <div class="row">
                                            @if(isset($img[0]))
                                            <div class="col-4">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[0]}}" class="img-fluid">
                                            </div>@endif
                                            @if(isset($img[1]))
                                            <div class="col-4">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[1]}}" class="img-fluid">
                                            </div>@endif
                                            @if(isset($img[2]))
                                            <div class="col-4">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[2]}}" class="img-fluid">
                                            </div>@endif
                                        </div>
                                        
                                        <div class="row mt-1">
                                            @if(isset($img[3]))
                                            <div class="col-4">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[3]}}" class="img-fluid">
                                            </div>@endif
                                            @if(isset($img[4]))
                                            <div class="col-4">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[4]}}" class="img-fluid">
                                            </div>@endif
                                            @if(isset($img[5]))
                                            <div class="col-4">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[5]}}" class="img-fluid">
                                            </div>@endif
                                        </div>
                                    @elseif(count($img)<=9)
                                        <div class="row">
                                            <div class="col-4">
                                                @isset($img[0])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[0]}}" class="img-fluid">@endisset
                                            </div>
                                            <div class="col-4">
                                                @isset($img[1])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[1]}}" class="img-fluid">@endisset
                                            </div>
                                            <div class="col-4">
                                                @isset($img[2])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[2]}}" class="img-fluid">@endisset
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-1">
                                            <div class="col-4">
                                                @isset($img[3])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[3]}}" class="img-fluid">@endisset
                                            </div>
                                            <div class="col-4">
                                                @isset($img[4])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[4]}}" class="img-fluid">@endisset
                                            </div>
                                            <div class="col-4">
                                                @isset($img[5])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[5]}}" class="img-fluid">@endisset
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-4">
                                                @isset($img[6])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[6]}}" class="img-fluid">@endisset
                                            </div>
                                            <div class="col-4">
                                                @isset($img[7])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[7]}}" class="img-fluid">@endisset
                                            </div>
                                            <div class="col-4">
                                                    @isset($img[8])<img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[8]}}" class="img-fluid">@endisset
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            @if(isset($img[0]))
                                            <div class="col-6">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[0]}}" class="img-fluid">
                                            </div>@endif
                                            @if(isset($img[1]))
                                            <div class="col-6">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[1]}}" class="img-fluid">
                                            </div>@endif
                                        </div>
                                        <div class="row">
                                            @if(isset($img[2]))
                                            <div class="col-6">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[2]}}" class="img-fluid">
                                            </div>@endif
                                            @if(isset($img[3]))
                                            <div class="col-6">
                                                <img src="{{asset('capturas')}}/{{$historial->procedimiento_id.'/'.$img[3]}}" class="img-fluid">
                                            </div>@endif
                                        </div>
                                    @endif
                                </div>
                                
                                    
                                
                                
                                    <form action="{{ route('procedimiento.dropzoneEdit', [$historial->id]) }}" id="my-awesome-dropzone" class="dropzone dropzonetoggle" enctype="multipart/form-data" method="post">
                                        @csrf
                                        {{-- <input type="hidden" name="reporte_id" value="{{$id}}"> --}}
                                        <!-- Now setup your input fields -->                            
                                    </form>
                                    <button id="btn-capturas" class="btn btn-info btn-block mt-1">Cambiar capturas</button>
                                    <div class="row mt-1">
                                        @isset($des[0])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text1" placeholder="descripcion 1" value="{{ $des[0] }}">
                                        </div>@endisset
                                        @isset($des[1])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text2" placeholder="descripcion 2" value="{{ $des[1] }}">
                                        </div>@endisset
                                        @isset($des[2])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text3" placeholder="descripcion 3" value="{{ $des[2] }}">
                                        </div>@endisset
                                        @isset($des[3])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text4" placeholder="descripcion 4" value="{{ $des[3] }}">
                                        </div>@endisset
                                        @isset($des[4])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text5" placeholder="descripcion 5" value="{{ $des[4] }}">
                                        </div>@endisset
                                        @isset($des[5])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text6" placeholder="descripcion 6" value="{{ $des[5] }}">
                                        </div>@endisset
                                        @isset($des[6])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text7" placeholder="descripcion 4" value="{{ $des[6] }}">
                                        </div>@endisset
                                        @isset($des[7])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text8" placeholder="descripcion 5" value="{{ $des[7] }}">
                                        </div>@endisset
                                        @isset($des[8])
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="text9" placeholder="descripcion 6" value="{{ $des[8] }}">
                                        </div>@endisset
                                    </div>
                                    
                                    
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <textarea id="contenido" required class="textarea" placeholder="Contenido..."
                                    style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{ $procedimiento->contenido }}
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
        })
    })
    </script>
    <script src="{{asset("dropzone/dropzone.js")}}"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 9,
            timeout: 120000,
            maxFiles: 9,
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg',
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
                // Make sure that the form isn't actually being sent.
                if (myDropzone.getQueuedFiles().length == 0){
                    if ($('#preciob').css('display')=='none'){
                            var preciob='';
                        } else {
                            var preciob= $('#preciob').val();
                        }
                    $.post(
                        "{{ route('procedimiento.dropzoneEdit', [$historial->id]) }}",
                        {
                            '_token': '{{ csrf_token() }}',
                            'contenido':$('#contenido').val(),
                            'precio': $('#precio').val(),
                            'text1':$('#text1').val(),
                            'text2':$('#text2').val(),
                            'text3':$('#text3').val(),
                            'text4':$('#text4').val(),
                            'text5':$('#text5').val(),
                            'text6':$('#text6').val(),
                            'text3':$('#text7').val(),
                            'text4':$('#text8').val(),
                            'text5':$('#text9').val(),
                             @if(Auth::user()->doctor_id == 12 && $procedimiento->plantilla == 84)
                                'expediente':$("#expediente_paciente").val(),
                                'equipo':$("#equipo").val(),
                                'diagnostico_clinico':$("#diagnostico_clinico").val(),
                                'anestesiologo': $("#anestesiologo").val(),
                                'procedencia':$("#procedencia_paciente").val(),
                                'intervencion':$("#intervencion").val(),
                                'anestesia':$("#anestesia").val(),
                            @endif
                            'preciob':preciob
                        },
                        function(response){
                            window.open(url+'/'+response, '_blank');
                            window.location.href=urlPaciente;
                        }
                    );
                } else {
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
                @if(Auth::user()->doctor_id == 12 && $procedimiento->plantilla == 84)
                formData.append("expediente",$("#expediente_paciente").val());
                formData.append("equipo",$("#equipo").val());
                formData.append("diagnostico_clinico",$("#diagnostico_clinico").val());
                formData.append("anestesiologo",$("#anestesiologo").val());
                formData.append("procedencia",$("#procedencia_paciente").val());
                formData.append("intervencion",$("#intervencion").val());
                formData.append("anestesia",$("#anestesia").val());
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
                console.log(response);
                
            });
            this.on("errormultiple", function(files, response) {
                //$("#respuesta").html(response);
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
            });
            }
        };

       

        $(document).ready(function(){
            $('#btn-capturas').click(function(){
                $('#capturas').toggleClass('dropzonetoggle');
                $('#my-awesome-dropzone').toggleClass('dropzonetoggle');
            });
        });
        
    </script>
@endsection