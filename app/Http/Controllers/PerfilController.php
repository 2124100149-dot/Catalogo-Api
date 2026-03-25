<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller
{
    public function index()
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $usuario = Session::get('user_data');
        return view('perfil.index', compact('usuario'));
    }

    public function updateProfile(Request $request)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email'
        ]);

        $token = Session::get('auth_token');
        $userId = Session::get('user_id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->put("https://api.escuelajs.co/api/v1/users/{$userId}", [
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($response->successful()) {
            $usuarioActualizado = $response->json();
            Session::put('user_data', $usuarioActualizado);
            return back()->with('success', 'Perfil actualizado correctamente');
        }

        return back()->with('error', 'Error al actualizar perfil');
    }

    public function updateAvatar(Request $request)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $request->validate([
            'avatar' => 'required|url'
        ]);

        $token = Session::get('auth_token');
        $userId = Session::get('user_id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->put("https://api.escuelajs.co/api/v1/users/{$userId}", [
            'avatar' => $request->avatar
        ]);

        if ($response->successful()) {
            $usuarioActualizado = $response->json();
            Session::put('user_data', $usuarioActualizado);
            return back()->with('success', 'Imagen de perfil actualizada');
        }

        return back()->with('error', 'Error al actualizar imagen');
    }

    public function updatePassword(Request $request)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $token = Session::get('auth_token');
        $userId = Session::get('user_id');

        $usuario = Session::get('user_data');
        
        $loginResponse = Http::post('https://api.escuelajs.co/api/v1/auth/login', [
            'email' => $usuario['email'],
            'password' => $request->current_password
        ]);

        if (!$loginResponse->successful()) {
            return back()->with('error', 'Contraseña actual incorrecta');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->put("https://api.escuelajs.co/api/v1/users/{$userId}", [
            'password' => $request->new_password
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Contraseña actualizada correctamente');
        }

        return back()->with('error', 'Error al actualizar contraseña');
    }
}