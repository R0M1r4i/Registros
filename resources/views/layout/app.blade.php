
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Actas</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.css')}} ">


    <link rel="stylesheet"  href=" {{ asset('assets/css/app.css')}}">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>


         .logo {
             display: flex;
             justify-content: center;
             align-items: center;
             width: 160px;
             height: 40px;

         }

        .logo img {
            width: 160px; /* La imagen se ajustará al ancho del contenedor */

            object-fit: cover; /* Ajusta la imagen sin distorsionarla */
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
                        <a href="#" id="logo-link">
                            <!-- el logo se insertará aquí dinámicamente -->
                        </a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">

                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active ">
                        <a href="{{ route('dashboard') }}" class='sidebar-link'>
                            <i class="fa-solid fa-folder-minus fa-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Menú de Registros (accesible por admin y editor) -->
                    @if(auth()->check() && (auth()->user()->rol === 'editor' || auth()->user()->rol === 'admin'))
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa-solid fa-address-card fa-lg"></i>
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


                        <li class="sidebar-title">Libros</li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa-solid fa-book-bookmark fa-lg"></i>
                                <span>Libros</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{ route('libro.index') }}">Registro de Libros</a>
                                </li>


                            </ul>
                        </li>

                    <li class="sidebar-title">Auditoria</li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="fa-solid fa-shield-halved fa-lg"></i>
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
                            <i class="fa-solid fa-users fa-lg"></i>
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
                                <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </form>
                    </li>





                </ul>
            </div>

        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="fa-solid fa-list fa-xl"></i>
            </a>
        </header>


        @yield('content')




    </div>
</div>


<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>


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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrasar la carga del logo
        setTimeout(() => {
            const logoLink = document.getElementById('logo-link');
            const logoImg = document.createElement('img');
            logoImg.src = '{{ asset("assets/images/logo/logoOmar.webp") }}';
            logoImg.alt = 'Logo';
            logoImg.classList.add('img-fluid');
            logoImg.loading = 'lazy';
            logoLink.appendChild(logoImg);
        }, 1000); // Cargar el logo después de 1 segundo
    });
</script>



</html>

