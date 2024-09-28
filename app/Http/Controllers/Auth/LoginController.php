<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar la solicitud de inicio de sesión
    public function login(Request $request)
    {
        // Validar los campos de la solicitud
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // Si la autenticación es exitosa, redirigir al dashboard
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // Si la autenticación falla, redirigir de vuelta al formulario con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

    // Procesar el cierre de sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

