<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'avatar' => 'nullable|url'
        ]);

        // Enviar a la API de Platzi
        $response = Http::post('https://api.escuelajs.co/api/v1/users/', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'avatar' => $request->avatar ?? 'https://api.lorem.space/image/face?w=150&h=150',
            'role' => 'customer'
        ]);

        if ($response->successful()) {
            $usuario = $response->json();
            
            $loginResponse = Http::post('https://api.escuelajs.co/api/v1/auth/login', [
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($loginResponse->successful()) {
                $tokenData = $loginResponse->json();
                
                Session::put('auth_token', $tokenData['access_token']);
                Session::put('user_id', $usuario['id']);
                Session::put('user_data', $usuario);
                
                return redirect()->route('perfil')->with('success', 'Registro exitoso. Bienvenido!');
            }
            
            return redirect()->route('login')->with('success', 'Registro exitoso. Inicia sesión.');
        }
        
        return back()->with('error', 'Error al registrar usuario. El email puede estar en uso.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $response = Http::post('https://api.escuelajs.co/api/v1/auth/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $token = $data['access_token'];
            
            $userResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('https://api.escuelajs.co/api/v1/auth/profile');
            
            if ($userResponse->successful()) {
                $usuario = $userResponse->json();
                
                Session::put('auth_token', $token);
                Session::put('user_id', $usuario['id']);
                Session::put('user_data', $usuario);
                
                return redirect()->route('perfil')->with('success', 'Bienvenido ' . $usuario['name']);
            }
        }
        
        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        Session::forget('auth_token');
        Session::forget('user_id');
        Session::forget('user_data');
        
        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente');
    }
}