
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
                                                                @method('PUT')
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
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group position-relative">
                                                                        <label for="contrasena2">Contraseña (Opcional)</label>
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control" name="contrasena" id="contrasena2">
                                                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                        </div>
                                                                        <small class="form-text text-muted">
                                                                            La contraseña debe cumplir con:
                                                                            <ul id="password-rules-edit">
                                                                                <li id="rule-length-edit">❌ Tener al menos 8 caracteres.</li>
                                                                                <li id="rule-uppercase-edit">❌ Incluir una letra mayúscula.</li>
                                                                                <li id="rule-lowercase-edit">❌ Incluir una letra minúscula.</li>
                                                                                <li id="rule-number-edit">❌ Incluir un número.</li>
                                                                                <li id="rule-symbol-edit">❌ Incluir un símbolo (por ejemplo: @, #, $).</li>
                                                                            </ul>
                                                                        </small>
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
                            </select>
                        </div>
                        <div class="form-group position-relative">
                            <label for="contrasena">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">
                                La contraseña debe cumplir con:
                                <ul id="password-rules">
                                    <li id="rule-length-creation">❌ Tener al menos 8 caracteres.</li>
                                    <li id="rule-uppercase-creation">❌ Incluir una letra mayúscula.</li>
                                    <li id="rule-lowercase-creation">❌ Incluir una letra minúscula.</li>
                                    <li id="rule-number-creation">❌ Incluir un número.</li>
                                    <li id="rule-symbol-creation">❌ Incluir un símbolo (por ejemplo: @, #, $).</li>
                                </ul>
                            </small>
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





    <script>
        // Validación para el formulario de creación
        const passwordInputCreation = document.getElementById('contrasena');
        const passwordRulesCreation = {
            length: document.getElementById('rule-length-creation'),
            uppercase: document.getElementById('rule-uppercase-creation'),
            lowercase: document.getElementById('rule-lowercase-creation'),
            number: document.getElementById('rule-number-creation'),
            symbol: document.getElementById('rule-symbol-creation'),
        };

        passwordInputCreation.addEventListener('input', function () {
            const password = this.value;

            passwordRulesCreation.length.textContent = password.length >= 8 ? '✅ Tener al menos 8 caracteres.' : '❌ Tener al menos 8 caracteres.';
            passwordRulesCreation.uppercase.textContent = /[A-Z]/.test(password) ? '✅ Incluir una letra mayúscula.' : '❌ Incluir una letra mayúscula.';
            passwordRulesCreation.lowercase.textContent = /[a-z]/.test(password) ? '✅ Incluir una letra minúscula.' : '❌ Incluir una letra minúscula.';
            passwordRulesCreation.number.textContent = /[0-9]/.test(password) ? '✅ Incluir un número.' : '❌ Incluir un número.';
            passwordRulesCreation.symbol.textContent = /[!@#$%^&*(),.?":{}|<>]/.test(password) ? '✅ Incluir un símbolo.' : '❌ Incluir un símbolo.';
        });

        // Validación para el formulario de edición
        const passwordInputEdit = document.getElementById('contrasena2');
        const passwordRulesEdit = {
            length: document.getElementById('rule-length-edit'),
            uppercase: document.getElementById('rule-uppercase-edit'),
            lowercase: document.getElementById('rule-lowercase-edit'),
            number: document.getElementById('rule-number-edit'),
            symbol: document.getElementById('rule-symbol-edit'),
        };

        passwordInputEdit.addEventListener('input', function () {
            const password = this.value;

            passwordRulesEdit.length.textContent = password.length >= 8 ? '✅ Tener al menos 8 caracteres.' : '❌ Tener al menos 8 caracteres.';
            passwordRulesEdit.uppercase.textContent = /[A-Z]/.test(password) ? '✅ Incluir una letra mayúscula.' : '❌ Incluir una letra mayúscula.';
            passwordRulesEdit.lowercase.textContent = /[a-z]/.test(password) ? '✅ Incluir una letra minúscula.' : '❌ Incluir una letra minúscula.';
            passwordRulesEdit.number.textContent = /[0-9]/.test(password) ? '✅ Incluir un número.' : '❌ Incluir un número.';
            passwordRulesEdit.symbol.textContent = /[!@#$%^&*(),.?":{}|<>]/.test(password) ? '✅ Incluir un símbolo.' : '❌ Incluir un símbolo.';
        });

        // Mostrar/Ocultar contraseñas
        document.getElementById('togglePassword').addEventListener('click', function () {
            const icon = this.querySelector('i');
            const input = document.getElementById('contrasena');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        document.getElementById('togglePassword2').addEventListener('click', function () {
            const icon = this.querySelector('i');
            const input = document.getElementById('contrasena2');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>




@endsection









