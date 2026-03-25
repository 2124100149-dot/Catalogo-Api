<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PedidoController;

// Páginas estáticas
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Rutas del catálogo 
Route::get('/catalogo', [ProductoController::class, 'index'])->name('catalogo');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.detalle');

// Rutas del carrito 
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::put('/carrito/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// Rutas de autenticación
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de perfil
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::put('/perfil', [PerfilController::class, 'updateProfile'])->name('perfil.update');
Route::put('/perfil/avatar', [PerfilController::class, 'updateAvatar'])->name('perfil.avatar');
Route::put('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password');

// Rutas de pedidos (requieren autenticación)
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
Route::put('/pedidos/{id}/cancelar', [PedidoController::class, 'cancel'])->name('pedidos.cancel');