
@extends('layout.app')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp



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


    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h6 class="text-muted font-semibold">Nombre y Apellidos</h6>
                                        <h6 class="font-extrabold mb-0">{{$defuncion->nombres}} {{$defuncion -> apellidos}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h6 class="text-muted font-semibold">Tipo de Acta</h6>
                                        <h6 class="font-extrabold mb-0">Acta de Defuncion</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h6 class="text-muted font-semibold">Fecha de Nacimiento</h6>
                                        <h6 class="font-extrabold mb-0">{{ Carbon::parse($defuncion->f_nacimiento)->format('d/m/Y') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h6 class="text-muted font-semibold">Último Registro</h6>
                                        <h6 class="font-extrabold mb-0">{{ Carbon::parse($defuncion->updated_at)->format('d/m/Y H:i:s') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ Storage::url($defuncion->ruta_doc) }}" target="_blank" class="btn btn-secondary">
                    Descargar PDF
                </a>

                <!-- Botón para imprimir el PDF -->
                <button class="btn btn-primary" onclick="printPDF()">Imprimir PDF</button>

                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $defuncion->id }}">
                    <i class="bi bi-pencil"></i> Editar
                </button>



                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Acta de Defuncion</h4>
                            </div>

                            <div class="pdf-viewer ">
                                <iframe src="{{ Storage::url($defuncion->ruta_doc) }}" width="100%" height="600px"></iframe>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </section>
    </div>


    <!-- Modal para editar registro -->
    <div class="modal fade" id="editModal{{ $defuncion->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $defuncion->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $defuncion->id }}">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('defuncion.update', $defuncion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" class="form-control" value="{{ $defuncion->nombres }}" required>
                        </div>

                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" value="{{ $defuncion->apellidos }}" required>
                        </div>

                        <div class="form-group">
                            <label for="f_nacimiento">Fecha de Nacimiento</label>
                            <input type="text" id="f_nacimiento" name="f_nacimiento" class="form-control" value="{{ old('f_nacimiento', \Carbon\Carbon::parse($defuncion->f_nacimiento)->format('d/m/Y')) }}" required>
                        </div>


                        <div class="form-group">
                            <label for="ruta_doc">Subir nuevo documento (PDF)</label>
                            <input type="file" name="ruta_doc" class="form-control" accept="application/pdf">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        // Función para imprimir el PDF
        function printPDF() {
            var pdfFrame = document.querySelector('.pdf-viewer iframe');
            pdfFrame.contentWindow.print();
        }
    </script>





@endsection



