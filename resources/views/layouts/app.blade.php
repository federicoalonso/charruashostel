<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'App Kpacite') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Dashboard -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <!-- overScroll Bars -->
    <link href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" rel="stylesheet">
</head>

<body>
    <div id="app" class="wrapper">
        <!-- ***************************************
                        Menu Superior 
        **************************************** -->
        <nav class="navbar navbar-expand navbar-light nav-superior">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </nav>


        <!-- ***************************************
                        Menu Lateral 
        **************************************** -->
        <div class="sidebar">
            <div class="marca">
                <!-- <span>C</span>harrúas <span>H</span>ostel -->
                <span>Charrúas</span> Hostel
            </div>
            <div class="sidebar-menu">
                <center class="profile">
                    <img src="/img/AvatarIndio.png" alt="">
                    <p>Admin</p>
                </center>
                <li class="item">
                    <a href="#" class="manu-btn">
                        <i class="fa fa-desktop"><span>Escritorio</span></i>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="manu-btn">
                        <i class="fa fa-boxes"><span>Productos <i class="fa fa-chevron-down drop-down"></i></span></i>
                    </a>
                    <div class="sub-menu">
                        <a href="#"><i class="fa fa-list-ul"></i><span>Resumen</span></a>
                        <a href="#"><i class="fa fa-whmcs"></i><span>Configuración</span></a>
                    </div>
                </li>
            </div>
        </div>


        <main class="py-4">
            @yield('content')
        </main>

    </div>

    <!-- overScroll Bars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/plugins/overlayScrollbars/js/OverlayScrollbars.min.js"></script>
</body>

</html>