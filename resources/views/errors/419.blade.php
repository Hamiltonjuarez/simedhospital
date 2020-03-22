<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset("assets/dist/css/adminlte.min.css")}}">    
        <!-- Styles -->
        <style>
           html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 35px;
            }

            .links > a {
                color: #white;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;             
            }          
            .m-b-md {
                margin-bottom: 30px;
            }
            .error{
                position: fixed;
                top: 80%;
                left: 31%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                       SU SESION HA EXPIRADO, POR FAVOR RECARGUE LA PAGINA E INTENTE NUEVAMENTE.
                </div>
                <div class="links">
                    <button type="button"  class="btn  btn-primary" onclick="window.location = '{{route('login')}}'">REGRESAR A LOGIN </button>
                </div>
                <div class="error">
                    Si el error persiste, por favor llamar a soporte técnico: (+503) 2210-0203.
                </div>
            </div>
        </div>
    </body>
</html>
