<?php

use App\Http\Controllers\ActaDefuncionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\MatrimonioController;
use App\Http\Controllers\NacimientoController;


use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\LogController;


Route::get('/', function () {
    return view('login.login');
});




// Mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Manejar el login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/validacion', function () {
    return view('validacion.index');
})->name('validacion.index');;

Route::get('/validacion/vista', function () {
    return view('validacion.vista');
})->name('validacion.vista');;


// Rutas privadas con autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas accesibles para ambos roles
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // En web.php
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/actas-mensuales', [DashboardController::class, 'getActasMensuales']);
    Route::get('/dashboard/totales-por-categoria', [DashboardController::class, 'getTotalesPorCategoria']);



    // Rutas para el editor (solo registros)
    Route::middleware(['role:editor'])->group(function () {

        Route::resource('nacimiento', NacimientoController::class)->only(['index', 'create', 'store', 'edit', 'update']);

        Route::resource('matrimonio', MatrimonioController::class)->only(['index', 'create', 'store', 'edit', 'update']);

        Route::resource('defuncion', ActaDefuncionController::class)->only(['index', 'create', 'store', 'edit', 'update']);;


        Route::get('/buscar-acta-nacimiento', [BusquedaController::class, 'buscarActaNacimiento'])->name('buscar.acta.nacimiento');

        Route::get('/buscar-acta-matrimonio', [BusquedaController::class, 'buscarActaMatrimonio'])->name('buscar.acta.matrimonio');

        Route::get('/buscar-acta-defuncion', [BusquedaController::class, 'buscarActaDefuncion'])->name('buscar.acta.defuncion');

    });

    // Rutas para el administrador (acceso completo)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('usuario', UsuarioController::class);

        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

      Route::resource('libro', LibroController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    });

    // Ruta para el logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

