
@extends('layout.app')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp


    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif


    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="page-heading">
        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabla de Actas de Matrimonio</h3>
                    <p class="text-subtitle text-muted">Registro de Actas y Consultas</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Acta de Matrimonio</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>


        <!-- Hoverable rows start -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Registros</h4>
                        </div>

                        <div class="modal-primary me-1 mb-1 d-inline-block">
                            <!-- Button trigger for primary themes modal -->
                            <button type="button" class="btn btn-outline-primary" style="margin-left: 25px;margin-bottom: 5px"
                                    data-bs-toggle="modal" data-bs-target="#primary">
                                Nuevo
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                </div>

                                <div class="col-sm-6">
                                    <h6>Buscar Acta de Matrimonio</h6>
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" id="buscar-acta" placeholder="Ingresar primer Nombre y primer Apellido">
                                        <div class="form-control-icon">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    </div>

                                    <!-- Botón de búsqueda -->
                                    <button type="button" class="btn btn-primary mt-2" onclick="cargarActas()">Buscar</button>

                                    <!-- Botón de limpiar búsqueda -->
                                    <button type="button" class="btn btn-secondary mt-2" onclick="limpiarBusqueda()">Limpiar</button>




                                </div>

                                <div class="col-sm-3">

                                </div>

                                <div class="col-sm-3 " style="margin-top: 15px">

                                    <h6>Total de Actas de Matrimonio: <strong id="contador-registros">{{ $totalMatrimonio }}</strong></h6>

                                </div>



                            </div>
                        </div>

                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tabla-resultados">
                                    <!-- Aquí se cargarán los resultados dinámicos -->
                                    @foreach ($matrimonios as $matrimonio)
                                        <tr>
                                            <td class="text-bold-500">{{ $matrimonio->nombres }}</td>
                                            <td>{{ $matrimonio->apellidos }}</td>
                                            <td class="text-bold-500">{{ \Carbon\Carbon::parse($matrimonio->f_nacimiento)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <a href="{{ route('matrimonio.edit', $matrimonio->id) }}" class="btn icon icon-left btn-primary">
                                                        <i data-feather="edit"></i> Detalles
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Contenedor para los enlaces de paginación -->
                            <div id="pagination-links" class="m-3"></div>


                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->
    </div>


    <!--primary theme Modal -->
    <div class="modal fade text-left" id="primary" tabindex="-1"
         role="dialog" aria-labelledby="myModalLabel160"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
             role="document">
            <div class="modal-content">

                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Registrar Nueva Acta de Matrimonio</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form action="{{ route('matrimonio.store') }}" method="POST" enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Nombres</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="nombres" placeholder="Nombres"
                                                               required maxlength="255" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                                                               title="El campo solo puede contener letras y espacios.">
                                                        <div class="form-control-icon">
                                                            <i class="fa-regular fa-user fa-sm"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="apellidos">Apellidos</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                                                               required maxlength="255" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                                                               title="El campo solo puede contener letras y espacios.">
                                                        <div class="form-control-icon">
                                                            <i class="fa-solid fa-signature fa-sm"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="f_nacimiento">Fecha de Nacimiento</label>
                                                    <div class="position-relative">
                                                        <input type="text" id="f_nacimiento"  class="form-control" name="f_nacimiento" required
                                                               pattern="\d{2}/\d{2}/\d{4}"
                                                               title="La fecha debe tener el formato dd/mm/yyyy.">

                                                        <div class="form-control-icon">
                                                            <i class="fa-regular fa-calendar-days fa-sm"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group ">
                                                    <label for="ruta_doc">Documento (PDF)</label>

                                                    <div class="input-group mb-3">
                                                        <label class="input-group-text" for="inputGroupFile01">
                                                            <i class="fa-regular fa-file-pdf"></i>
                                                        </label>
                                                        <input type="file" class="form-control" name="ruta_doc" accept="application/pdf" required
                                                               title="Solo se permite subir archivos en formato PDF.">
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Guardar</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let currentPage = 1;

        // Función para cargar los datos por AJAX
        function cargarActas(page = 1) {
            let query = document.getElementById('buscar-acta').value;

            fetch(`/buscar-acta-matrimonio?query=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    let tablaResultados = document.getElementById('tabla-resultados');
                    tablaResultados.innerHTML = '';  // Limpiar resultados anteriores

                    if (data.data.length > 0) {
                        data.data.forEach(acta => {
                            let fila = document.createElement('tr');
                            fila.innerHTML = `
                        <td class="text-bold-500">${acta.nombres}</td>
                        <td>${acta.apellidos}</td>
                        <td class="text-bold-500">${acta.fecha}</td>
                        <td>
                            <div class="buttons">
                                <a href="/matrimonio/${acta.id}/edit/" class="btn icon icon-left btn-primary">
                                    <i data-feather="edit"></i> Detalles
                                </a>
                            </div>
                        </td>
                    `;
                            tablaResultados.appendChild(fila);
                        });

                        // Actualizar el contador dinámicamente
                        document.getElementById('contador-registros').textContent = data.total;

                        // Mostrar los botones de paginación
                        let paginationLinks = document.getElementById('pagination-links');
                        paginationLinks.innerHTML = generatePaginationLinks(data);
                    } else {
                        tablaResultados.innerHTML = '<tr><td colspan="4" class="text-center">No se encontraron resultados.</td></tr>';
                    }
                });
        }

        function generatePaginationLinks(data) {
            let paginationHTML = '';

            // Enlace a la página anterior
            if (data.prev_page_url) {
                paginationHTML += `<a href="#" data-page="${data.current_page - 1}" class="btn btn-primary" style="margin-right: 5px">Anterior</a>`;
            }

            // Mostrar los números de página, por ejemplo: 1, 2, ..., 19, 20
            let totalPages = data.last_page;
            let currentPage = data.current_page;
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {
                paginationHTML += `<a href="#" data-page="1" class="btn btn-outline-primary" style="margin-right: 5px">1</a>`;
                if (startPage > 2) paginationHTML += `<span class="dots" style="margin-right: 5px">...</span>`;
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `<a href="#" data-page="${i}" class="btn ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}" style="margin-right: 5px">${i}</a>`;
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) paginationHTML += `<span class="dots" style="margin-right: 5px">...</span>`;
                paginationHTML += `<a href="#" data-page="${totalPages}" class="btn btn-outline-primary" style="margin-right: 5px">${totalPages}</a>`;
            }

            // Enlace a la página siguiente
            if (data.next_page_url) {
                paginationHTML += `<a href="#" data-page="${data.current_page + 1}" class="btn btn-primary">Siguiente</a>`;
            }

            return paginationHTML;
        }

        // Manejar clics en los botones de paginación
        document.getElementById('pagination-links').addEventListener('click', function (event) {
            if (event.target.tagName === 'A') {
                event.preventDefault();
                let page = event.target.getAttribute('data-page');
                cargarActas(page);  // Cargar la página solicitada
            }
        });

        // Función para limpiar la búsqueda
        function limpiarBusqueda() {
            document.getElementById('buscar-acta').value = '';  // Vaciar el campo de búsqueda
            cargarActas();  // Cargar los primeros 10 registros sin filtro
        }

        // Cargar primeros 10 registros al iniciar
        cargarActas();


    </script>







@endsection











