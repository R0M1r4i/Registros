
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.css')}} ">

    <link rel="stylesheet" href=" {{ asset('assets/vendors/iconly/bold.css')}} ">

    <link rel="stylesheet" href=" {{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}} ">
    <link rel="stylesheet"  href=" {{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet"  href=" {{ asset('assets/css/app.css')}}">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        .logo img {

            width: 160px; /* La imagen se ajustará al ancho del contenedor */

            object-fit: cover;
        }

    </style>


</head>



<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href=""><img src="{{ asset('assets/images/logo/logoOmar.png')}}" alt="Logo" class="img-fluid"></a>
                    </div>
                    <div class="toggler">
                        <a href="{{ route('dashboard') }}" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">

                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active ">
                        <a href="{{ route('dashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Menú de Registros (accesible por admin y editor) -->
                    @if(auth()->check() && (auth()->user()->rol === 'editor' || auth()->user()->rol === 'admin'))
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Registros</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ route('nacimiento.index') }}">Registrar Acta de Nacimiento</a>
                                </li>

                                <li class="submenu-item">
                                    <a href="{{ route('matrimonio.index') }}">Registrar Acta de Matrimonio</a>
                                </li>

                                <li class="submenu-item">
                                    <a href="{{ route('defuncion.index') }}">Registrar Acta de Defuncion</a>
                                </li>
                            </ul>
                        </li>
                    @endif



                    <!-- Menú de Logs (accesible solo para admin) -->
                    @if(auth()->check() && auth()->user()->rol === 'admin')

                    <li class="sidebar-title">Auditoria</li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Logs</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('logs.index') }}">Logs de Auditoría</a>
                            </li>


                        </ul>
                    </li>





                    <li class="sidebar-title">Usuarios</li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Usuarios</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('usuario.index') }}">Registrar Usuarios</a>
                            </li>

                        </ul>
                    </li>
                    @endif

                    <li class="sidebar-item">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </form>
                    </li>





                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>


        @yield('content')




    </div>
</div>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('assets/js/main.js')}}"></script>
</body>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#f_nacimiento", {
            dateFormat: "d/m/Y",
            allowInput: true
        });
    });
</script>



</html>

