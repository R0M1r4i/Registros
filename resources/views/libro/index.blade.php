
@extends('layout.app')

@section('content')


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
                    <h3>Tabla de Libros</h3>
                    <p class="text-subtitle text-muted">Registro de Libros</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Libros</li>
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
                                    data-bs-toggle="modal" data-bs-target="#usuarioModal">
                                Nuevo
                            </button>
                        </div>




                        <div class="card-content">

                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th> Codigo</th>
                                        <th>Nombre del Libro</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($libros  as $libro)
                                        <tr>
                                            <td>{{ $libro->id_libro }}</td>
                                            <td>{{ $libro->nombre_libro }}</td>

                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#libroEditModal{{ $libro->id_libro }}">
                                                    Editar
                                                </button>

                                                <!-- Modal de edición -->
                                                <div class="modal fade" id="libroEditModal{{ $libro->id_libro }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Editar Libro</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('libro.update', $libro->id_libro) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="nombre_libro">Usuario</label>
                                                                        <input type="text" class="form-control" name="nombre_libro" value="{{ $libro->nombre_libro }}" required>
                                                                    </div>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->
    </div>


    <!-- Modal de nuevo libro -->
    <div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usuarioModalLabel">Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('libro.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre_libro">Libro</label>
                            <input type="text" class="form-control" name="nombre_libro" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>








@endsection









