<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Actas</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">


</head>

<body>
<div id="auth">

    <div class="row h-100">


        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo"></div>
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Ingresa tus credenciales para iniciar sesión.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ htmlspecialchars($error) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @method('POST')
                    @csrf

                    <!-- Agregar campo honeypot -->
                    <div class="d-none">
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text"
                               class="form-control form-control-xl"
                               name="usuario"
                               placeholder="usuario"
                               required
                               maxlength="50"
                               pattern="[a-zA-Z0-9_-]{3,50}"
                               autocomplete="username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"
                               class="form-control form-control-xl"
                               name="password"
                               placeholder="contraseña"
                               required
                               minlength="8"
                               maxlength="100"
                               autocomplete="current-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>



                    <button type="submit"
                            class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                            onclick="this.disabled=true;this.form.submit();">
                        Ingresar
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>
</body>


</html>

