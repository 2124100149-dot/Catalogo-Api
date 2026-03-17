@extends('layouts.app')

@section('title', $producto['title'] ?? 'Detalle del Producto')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    @if(isset($error))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ $error }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2 p-8">
                    <img src="{{ $producto['image'] }}" 
                         alt="{{ $producto['title'] }}"
                         class="w-full h-auto object-contain">
                </div>
                
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $producto['title'] }}
                    </h1>
                    
                    <p class="text-sm text-gray-500 mb-2">
                        Categoría: {{ $producto['category'] }}
                    </p>
                    
                    <div class="mb-4">
                        <span class="text-3xl font-bold text-blue-600">
                            ${{ number_format($producto['price'], 2) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center mb-6">
                        <span class="text-yellow-400 text-xl mr-2">★</span>
                        <span class="text-gray-700">{{ $producto['rating']['rate'] }} / 5</span>
                        <span class="text-gray-500 ml-2">({{ $producto['rating']['count'] }} valoraciones)</span>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold mb-2">Descripción:</h2>
                        <p class="text-gray-700">{{ $producto['description'] }}</p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold mb-2">Disponibilidad:</h2>
                        <p class="text-green-600">✓ En stock</p>
                        <p class="text-sm text-gray-500">Existencia: 30 unidades disponibles</p>
                    </div>
                    
                    <a href="{{ route('catalogo') }}" 
                       class="inline-block bg-gray-200 text-gray-700 py-2 px-6 rounded-lg hover:bg-gray-300 transition">
                        ← Volver al catálogo
                    </a>
                </div>
            </div>
            
            <div class="border-t p-8">
                <h2 class="text-xl font-semibold mb-4">Galería de imágenes</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border rounded-lg p-2">
                        <img src="{{ $producto['image'] }}" 
                             alt="Imagen 1" 
                             class="w-full h-32 object-contain">
                    </div>
                    <div class="border rounded-lg p-2">
                        <img src="{{ $producto['image'] }}" 
                             alt="Imagen 2" 
                             class="w-full h-32 object-contain">
                    </div>
                    <div class="border rounded-lg p-2">
                        <img src="{{ $producto['image'] }}" 
                             alt="Imagen 3" 
                             class="w-full h-32 object-contain">
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    * Reutilizo la misma imagen, porque no hay mas disponibles en fakestoreapi.
                </p>
            </div>
        </div>
    @endif
</div>
@endsection