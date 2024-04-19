<?php

namespace App\Http\Controllers;

use App\Mail\PasswordMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $password = mt_rand(100000, 999999);
        //Validar datos
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
        ], $messages);
        //Crea el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        Mail::to($request->email)->send(new PasswordMailable($password));

        //Autentica el usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $password,
        ]);

        //Redirecciona el usuario
        return redirect()->route('products');
    }

    public function login(Request $request)
    {
        //Validar datos
        $request->validate([
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
