<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Vertical 1 Column - Mazer</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">



    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.css')}} ">


    <link rel="stylesheet"  href=" {{ asset('assets/css/app.css')}}">
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


<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Validacion de Actas</h4>
        </div>
        <div class="card-body">

            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ingrese el Hash del Acta </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Hash del Acta</label>
                                                        <input type="text" id="first-name-vertical" class="form-control"
                                                               name="fname" placeholder="Hash">
                                                    </div>
                                                </div>


                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Enviar</button>
                                                    <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- // Basic Vertical form layout section end -->

        </div>
    </div>
</div>



<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>


<script src="{{ asset('assets/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('assets/js/main.js')}}"></script>
</body>

</html>
