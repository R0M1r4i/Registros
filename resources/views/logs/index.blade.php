@extends('layout.app')

@section('content')
    <div class="container">
        <h2>Logs de Auditoría</h2>

        <!-- Buscador con selector de tipo de búsqueda -->
        <form method="GET" action="{{ route('logs.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="query" class="form-control" placeholder="Buscar..." value="{{ request('query') }}">
                </div>
                <div class="col-md-3">
                    <select name="search_type" class="form-control">
                        <option value="usuario" {{ request('search_type') === 'usuario' ? 'selected' : '' }}>Por Usuario</option>
                        <option value="registrado" {{ request('search_type') === 'registrado' ? 'selected' : '' }}>Por Persona Registrada</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Tabla de logs -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Tabla</th>
                    <th>ID del Registro</th>
                    <th>Detalles de Cambios</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->usuario_nombres }} {{ $log->usuario_apellidos }}</td>
                        <td>{{ ucfirst($log->accion) }}</td>
                        <td>{{ $log->tabla }}</td>
                        <td>{{ $log->id_registro }}</td>
                        <td>{{ $log->cambios }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $logs->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </div>





@endsection


