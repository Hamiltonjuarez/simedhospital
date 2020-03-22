<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
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
    <!-- style para perfiles -->
    <link rel="stylesheet" href="{{asset("assets/style.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @yield('styles')
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini sidebar-collapse">

    <div class="wrapper">
        @include('theme.guest.header')
        @include('theme.guest.menu')
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content" >
                <div class="container-fluid">
                    @yield('contenido')
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <footer class="main-footer">
                <strong>Copyright &copy; 2019 <a href="">SIIMED</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                  <b>Version</b> 1
                </div>
        </footer>
    </div>



    <!-- jQuery -->
    <script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset("assets/plugins/jQueryUI/jquery-ui.min.js")}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/dist/js/adminlte.js")}}"></script>

    <script src="{{asset("js/app.js")}}"></script>

    @yield('scripts')
    </body>

</html>
