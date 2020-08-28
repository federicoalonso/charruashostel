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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">

    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css"> -->
</head>

<body>
    <div id="app" class="wrapper">
        <!-- ***************************************
                        Menu Superior 
        **************************************** -->
        <menu-superior></menu-superior>

        <!-- ***************************************
                        Menu Lateral 
        **************************************** -->

        <sidebar-menu></sidebar-menu>


        <!-- ***************************************
                        Contenedor Principal
        **************************************** -->
        
        <router-view></router-view>

    </div>

    <!-- JQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>

    <!-- sweetAlert -->
    <script src="/plugins/sweetAlert/sweetalert2.all.min.js"></script>

    <!-- Script Página -->
    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
                $('.wrapper').toggleClass('colapsado');
            });
            $('.item').click(function() {
                $('.item').siblings('.item').removeClass('large');
                
                if (!hasClass(this.lastChild.lastChild, 'router-link-exact-active')) {
                    (hasClass(this, 'large')) ? this.classList.remove('large'): this.classList.add('large');
                }else{
                    this.classList.add('large');
                }
            });


            function hasClass(el, className) {
                if (el.classList)
                    return el.classList.contains(className);
                return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
            }

            $(".salirAlerta").click(function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Está seguro?',
                    text: "Seguro quiere abandonar la sesión?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Sí, finalizar!',
                    cancelButtonText: 'Cancelar'
                }).then(function(result) {
                    if (result.value) {
                        document.getElementById('logout-form').submit();
                    }
                })
            });
        });
    </script>
</body>

</html>