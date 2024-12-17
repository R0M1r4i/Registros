<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar la vista de login
    public function showLoginForm()
    {
        return view('login.login');
    }

    // Manejar el login
    public function login(Request $request)
    {
        // Validar credenciales
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        $credentials = ['usuario' => $request->usuario, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa, redirigir al dashboard
            return redirect()->intended('dashboard')->with('success', 'Inicio de sesión exitoso.');
        } else {
            // Si la autenticación falla, redirigir de vuelta con un error
            return redirect()->back()->withErrors('Credenciales incorrectas.');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Sesión cerrada exitosamente.');
    }
}
