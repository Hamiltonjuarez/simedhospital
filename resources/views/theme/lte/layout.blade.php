<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Integración Medica - SIIMED</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- logo --}}
    <link rel="shortcut icon" href="{{asset("assets/img/logosiimed.png")}}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/plugins/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset("assets/plugins/ionicons/ionicons.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/dist/css/adminlte.min.css")}}">
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet"/>
    <!-- style para perfiles -->
    <link rel="stylesheet" href="{{asset("assets/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables/datatables.bootstrap4.css")}}">
    <!--datatables-->
    <link rel="stylesheet" href="{{asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .badge-rosa{
            background-color: palevioletred;
        }/* 
        .titulo-cumples{
             background-image: url("{{asset('assets/img/confeti.jpg')}}");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
            } */
    </style>
    @yield('styles')
    
</head>
    <body class="hold-transition skin-purple-light sidebar-mini sidebar-collapse" >

    <div class="wrapper" id="globalVue">

        @include('theme.lte.header')
        @include('theme.lte.menu')
        <div class="content-wrapper" style="padding-top:10px;padding-bottom:50px;">

            <!-- Main content -->
            <section class="content" >
                <div class="container-fluid">
                    @yield('contenido')
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <footer class="main-footer fixed-bottom" style="z-index:200">
                <strong>Copyright &copy; 2019 <a href="">SIMED</a></strong>
                <div class="float-right d-none d-sm-inline-block">
                  <b>Soporte Técnico: (+503) 7851-3085 &nbsp;&nbsp;&nbsp;</b> 
                </div>
        </footer>

    </div>


    <!-- jQuery -->

    <script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("assets/plugins/jQueryUI/jquery-ui.min.js")}}"></script>
    <script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("assets/dist/js/adminlte.js")}}"></script>
    <script src="{{asset("js/app.js")}}"></script>
    <script src="{{asset("js/toastr.js")}}"></script>
    <script src="{{ asset("js/axios.js") }}"></script>

    {{--datatables--}}
    <script src="{{asset('assets/plugins/datatables/jquery.datatables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/datatables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/compresor.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/profile.js')}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script>
    
     Vue.component('diagnostico', {
            data: function() {
                return {
                    count: 0
                }
            },
            template: '<textarea class="form-control textarea "   name="diagnostico" cols="30" rows="10"   placeholder="Diagnóstico "></textarea>'
        });
        Vue.component('prescripcion', {
            data: function() {
                return {
                    count: 0
                }
            },
            template: '<textarea class="form-control textarea"   name="prescripcion" cols="30" rows="10"   placeholder="Prescripción"></textarea>'
        });
        var app2 = new Vue({
        el: '#app2',
        data: {
            seen: true
        }
        })

        const global = new Vue({
            el: '#globalVue',
            data:{
                doctor:'',
                notificaciones: [],
                biopsia:'',
                mostrar: false,
                mostrarDiag: false,
                mostrarDetalle: true,
                cumpleaneros: [],
                
            },
            methods:{
                getCumpleaneros(){
                    var urlcumples = "{{route('pacientes.cumples')}}";
                    axios.get(urlcumples).then(response =>{
                        for(var i=0; i<response.data.length; i++){
                            this.cumpleaneros.push({
                                nombre: response.data[i].nombre+response.data[i].apellidos, fecha: moment(response.data[i].nacimiento).calendar(), avatar: response.data[i].photo_extension, id: response.data[i].id, tel: response.data[i].telefono
                            });
                        }
                    });
                },
                getdoctorselect(){
                    var urldoctor = "{{route('home.doctorselect')}}";
                    axios.get(urldoctor).then(response =>{
                        this.doctor = response.data;
                    });
                },
                getNotificaciones(){
                    var url = "{{route('citas.notifications')}}";
                    axios.get(url).then(response => {
                        for (var i=0; i< response.data.length; i++){
                            this.notificaciones.push({
                                id: response.data[i].id , titulo: response.data[i].title, hora: moment(response.data[i].start).calendar(), paciente: response.data[i].nombre + ' ' + response.data[i].apellidos, estado: response.data[i].estado
                            })
                        }
                        this.cantidadNotificaciones = Object.keys(response.data).length;
                        if(this.cantidadNotificaciones > 0){
                            $("#notificaciones").show();
                        }
                    })
                },
                addDiag: function(){
    
                    if(this.mostrarDiag==false)
                    {
                        this.mostrarDiag = true;
                        this.mostrarDetalle = false;
                        this.mostrar = false;
                    }
                    else{
                        this.mostrarDiag = false;
                    }
                },
                addPres: function(){
                    if(this.mostrar==false)
                    {
                        this.mostrar = true;
                        this.mostrarDetalle = false;
                        this.mostrarDiag=false;
    
                    }
                    else{
                        this.mostrar = false;
                    }
                },
                addDetalle: function(){
                    if(this.mostrarDetalle==false)
                    {
                        this.mostrarDetalle=true;
                        this.mostrarDiag=false;
                        this.mostrar=false;
                    }
                    else{
                        this.mostrarDetalle=false;
                    }
                }
            },
            created: function(){
                this.getCumpleaneros();
                this.getNotificaciones();
                this.getdoctorselect();
            },
        });
    </script>
    @yield('scripts')
</body>

</html>