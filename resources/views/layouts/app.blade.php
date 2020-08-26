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
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
                    <a class="nav-link" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>


        <!-- ***************************************
                        Menu Lateral 
        **************************************** -->
        <div class="sidebar">
            <div class="marca marca-gde">
                <!-- <span>C</span>harrúas <span>H</span>ostel -->
                <span>Charrúas</span> Hostel
            </div>
            <div class="marca marca-sm">
                <span>C</span> H
            </div>
            <div class="sidebar-menu">
                <center class="profile">
                    <img src="/img/AvatarIndio.png" alt="">
                    <p>Admin</p>
                </center>
                <li class="item">
                    <a href="#" class="menu-btn">
                        <i class="fas fa-desktop"></i><span>Escritorio</span>
                    </a>
                </li>
                <li class="item" id="productos">
                    <a href="#productos" class="menu-btn">
                        <i class="fa fa-boxes"></i><span>Productos <i class="fa fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="#"><i class="fa fa-list-ul"></i><span>Resumen</span></a>
                        <a href="#"><i class="fas fa-cogs"></i><span>Configuración</span></a>
                    </div>
                </li>
                <li class="separator"></li>
                <li class="item">
                    <a href="{{ route('logout') }}" class="menu-btn salirAlerta">
                        <i class="nav-icon fas fa-power-off"></i>
                        <span>
                            Cerrar Sesión
                        </span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </div>
        </div>


        <!-- ***************************************
                        Contenedor Principal
        **************************************** -->
        <main class="main-container">
            @yield('content')
            <footer class="footer mt-5">
                <strong>Copyright © 2020 <a href="http://kpacite.com">Kpacite.com</a>.</strong>
                Derechos Reservados.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Versión</b> 1.0.0
                </div>
            </footer>
        </main>

    </div>

    <!-- JQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>

    <!-- sweetAlert -->
    <script src="/plugins/sweetAlert/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script src="/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- Script Página -->
    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
                $('.wrapper').toggleClass('colapsado');
            });

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

            var table = $('.data-table-js').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        });
    </script>
</body>

</html>