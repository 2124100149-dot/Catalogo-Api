<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

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

// Rutas del catálogo con controlador
Route::get('/catalogo', [ProductoController::class, 'index'])->name('catalogo');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.detalle');