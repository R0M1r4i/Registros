<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Vertical 1 Column - Mazer</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">



    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.css')}} ">


    <link rel="stylesheet"  href=" {{ asset('assets/css/app.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<script src="assets/static/js/initTheme.js"></script>
<nav class="navbar navbar-light">
    <div class="container d-block">
        <a href="index.html"><i class="bi bi-chevron-left"></i></a>
        <a class="navbar-brand ms-4" href="index.html">
            <img src="./assets/compiled/svg/logo.svg">
        </a>
    </div>
</nav>





<script>
    // Función para imprimir el PDF
    function printPDF() {
        var pdfFrame = document.querySelector('.pdf-viewer iframe');
        pdfFrame.contentWindow.print();
    }
</script>


<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Vista del Acta</h4>
        </div>
        <div class="card-body">
            <ul>
                <li>Verificar los datos asociados al Acta</li>
                <li>Hash Asociado al Acta: "Hash"</li>
            </ul>

        </div>
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
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="text-muted font-semibold">Nombre y Apellidos</h6>
                                            <h6 class="font-extrabold mb-0"></h6>
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
                                                <i class="fa-solid fa-file"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="text-muted font-semibold">Tipo de Acta</h6>
                                            <h6 class="font-extrabold mb-0">Acta de Matrimonio</h6>
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
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="text-muted font-semibold">Fecha de Nacimiento</h6>
                                            <h6 class="font-extrabold mb-0"></h6>
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
                                                <i class="fa-solid fa-list-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="text-muted font-semibold">Último Registro</h6>
                                            <h6 class="font-extrabold mb-0"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="" target="_blank" class="btn btn-secondary">
                        Descargar PDF
                    </a>

                    <!-- Botón para imprimir el PDF -->
                    <button class="btn btn-primary" onclick="printPDF()">Imprimir PDF</button>


                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Acta de Matrimonio</h4>
                                </div>

                                <div class="pdf-viewer ">
                                    <iframe src="" width="100%" height="600px"></iframe>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </section>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>


<script src="{{ asset('assets/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('assets/js/main.js')}}"></script>
</body>

</html>

