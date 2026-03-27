@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Bienvenido a Mi Catálogo
        </h1>
        <p class="text-xl text-gray-600 mb-8">
            Descubre nuestra colección de productos
        </p>
        <a href="{{ route('catalogo') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
            Ver Catálogo
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-12">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Productos de Calidad</h3>
            <p class="text-gray-600">Ofrecemos los mejores productos del mercado, para que te los lleves directamente a casa.</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Envío Rápido</h3>
            <p class="text-gray-600">Recibe tus productos en la puerta de tu casa y no camines por ellos.</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Mejores Precios</h3>
            <p class="text-gray-600">Los precios más competitivos del mercado, compralo ya.</p>
        </div>
    </div>
</div>
@endsection