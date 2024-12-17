
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
                    <h3>Tabla de Usuarios</h3>
                    <p class="text-subtitle text-muted">Registro de Usuarios</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
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

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                </div>
                                <div class="col-sm-6">
                                    <h6>Buscar Usuario</h6>
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control"
                                               placeholder="Ingresar Nombres y Apellidos">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="card-content">

                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($usuarios  as $usuario)
                                        <tr>
                                            <td>{{ $usuario->usuario }}</td>
                                            <td>{{ $usuario->nombres }}</td>
                                            <td>{{ $usuario->apellidos }}</td>
                                            <td>{{ $usuario->rol }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#usuarioEditModal{{ $usuario->id_usuario }}">
                                                    Editar
                                                </button>

                                                <!-- Modal de edición -->
                                                <div class="modal fade" id="usuarioEditModal{{ $usuario->id_usuario }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('usuario.update', $usuario->id_usuario) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="usuario">Usuario</label>
                                                                        <input type="text" class="form-control" name="usuario" value="{{ $usuario->usuario }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nombres">Nombres</label>
                                                                        <input type="text" class="form-control" name="nombres" value="{{ $usuario->nombres }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="apellidos">Apellidos</label>
                                                                        <input type="text" class="form-control" name="apellidos" value="{{ $usuario->apellidos }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="rol">Rol</label>
                                                                        <select name="rol" class="form-select" required>
                                                                            <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                                                                            <option value="editor" {{ $usuario->rol == 'editor' ? 'selected' : '' }}>Editor</option>
                                                                            <option value="viewer" {{ $usuario->rol == 'viewer' ? 'selected' : '' }}>Visualizador</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="contrasena">Contraseña (Opcional)</label>
                                                                        <input type="password" class="form-control" name="contrasena">
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


    <!-- Modal de nuevo usuario -->
    <div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usuarioModalLabel">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('usuario.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" name="nombres" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select name="rol" class="form-select" required>
                                <option value="admin">Administrador</option>
                                <option value="editor">Editor</option>
                                <option value="viewer">Visualizador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" required>
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









