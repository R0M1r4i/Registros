<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        // Verificar honeypot
        if ($request->filled('website')) {
            Log::warning('Posible intento de spam detectado', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            return redirect()->back()->withErrors('Error de validación');
        }

        // Rate limiting
        $key = 'login.' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->back()->withErrors("Demasiados intentos. Por favor espera {$seconds} segundos.");
        }


        $request->validate([
            'usuario' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9_-]{3,50}$/'],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()],
        ]);


        // Intento de autenticación
        $credentials = $request->only('usuario', 'password');

        if (Auth::attempt($credentials, false)) { // false = no "remember me"
            RateLimiter::clear($key);

            $request->session()->regenerate();

            Log::info('Login exitoso', ['usuario' => $request->usuario]);

            return redirect()
                ->intended('dashboard')
                ->with('success', 'Inicio de sesión exitoso.');
        }

        RateLimiter::hit($key);

        Log::warning('Intento de login fallido', [
            'usuario' => $request->usuario,
            'ip' => $request->ip()
        ]);

        return redirect()
            ->back()
            ->withErrors('Credenciales incorrectas.')
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Sesión cerrada exitosamente.');
    }
}
