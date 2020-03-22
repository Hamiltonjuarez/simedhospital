@extends('theme.lte.layout')
@section('styles')
    <link rel="stylesheet" href="{{asset("dropzone/dropzone.css")}}">
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-sm-10" id="main">

            <div class="card mt-2 card-primary">
                <div class="card-header text-center">
                    <h3 class="card-title">Agregar capturas al reporte</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                <form action="{{ route('dropzone', [$id, $model]) }}" id="my-awesome-dropzone" class="dropzone" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="text1" v-bind:value="info1">
                                    <input type="hidden" name="text2" v-bind:value="info2">
                                    <input type="hidden" name="text3" v-bind:value="info3">
                                    <input type="hidden" name="text4" v-bind:value="info4">
                                    <input type="hidden" name="text5" v-bind:value="info5">
                                    <input type="hidden" name="text6" v-bind:value="info6">
                                    {{-- <input type="hidden" name="reporte_id" value="{{$id}}"> --}}
                                    <!-- Now setup your input fields -->


                                </form>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <div class="form-group">
                                    <label for="img1">Descripcion de imagen 1</label>
                                    <input type="text" class="form-control form-control-sm" v-model="info1">
                                </div>
                                <div class="form-group">
                                    <label for="img2">Descripcion de imagen 2</label>
                                    <input type="text" class="form-control form-control-sm" v-model="info2">
                                </div>
                                <div class="form-group">
                                    <label for="img3">Descripcion de imagen 3</label>
                                    <input type="text" class="form-control form-control-sm" v-model="info3">
                                </div>
                                <div class="form-group">
                                    <label for="img4">Descripcion de imagen 4</label>
                                    <input type="text" class="form-control form-control-sm" v-model="info4">
                                </div>
                                <div class="form-group">
                                    <label for="img5">Descripcion de imagen 5</label>
                                    <input type="text" class="form-control form-control-sm" v-model="info5">
                                </div>
                                <div class="form-group">
                                    <label for="img6">Descripcion de imagen 6</label>
                                    <input type="text" class="form-control form-control-sm" v-model="info6">
                                </div>
                            </div>
                            <div>
                                <button type="btn" id="btndrop" class="btn btn-primary pull-right">Generar reporte</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset("dropzone/dropzone.js")}}"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 6,
            maxFiles: 6,
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg',

            // The setting up of the dropzone
            init: function() {
            var myDropzone = this;
            var url = "{{route('reportes.index')}}";

            // First change the button to actually tell Dropzone to process the queue.
            /* this.element.querySelector("button[type=submit]").addEventListener("click", function(e) { */
            document.querySelector("#btndrop").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
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
                if (response != 'error'){
                    window.location.href=url+'/'+response;
                }
            });
            this.on("errormultiple", function(files, response) {
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
            });
            }

        }
        new Vue({
            el: '#main',
            data: {
                info1: '',
                info2: '',
                info3: '',
                info4: '',
                info5: '',
                info6: ''
            }
        });
    </script>
@endsection
