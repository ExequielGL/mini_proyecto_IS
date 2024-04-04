<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $messages = makeMessages();
        //Validar datos
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5']
        ], $messages);
        //Crea el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        //Autentica el usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Redirecciona el usuario
        return redirect()->route('products');
    }

    public function login(Request $request)
    {
        //Validar datos
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);

        //Autentica el usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->back()->with('message', 'Credenciales incorrectas');
        }

        //Redirecciona el usuario
        return redirect()->route('products');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
