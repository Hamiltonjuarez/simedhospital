<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{public_path('css/css_reportes/bootstrap.css')}}">
    <link rel="stylesheet" href="{{public_path('/css/css_recetas/templateuno.css')}}">
    @yield('styles')
</head>
<body>
    <header>
        <hr class="bg-primary line-top" style="margin:0%;padding:0%;height:8px">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    @yield('content-header')
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
               <div class="col-xs-12">
                @yield('content-main')
               </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    @yield('content-footer')
                </div>
            </div>
        </div>
    </footer>
</body>
</html>