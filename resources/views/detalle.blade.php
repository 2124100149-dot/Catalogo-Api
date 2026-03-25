@extends('layouts.app')

@section('title', $producto['title'] ?? 'Detalle del Producto')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

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
                        <p class="text-sm text-gray-500">Existencia: 50 unidades disponibles</p>
                    </div>
                    
                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="id" value="{{ $producto['id'] }}">
                        
                        <div class="flex items-center space-x-4">
                            <button type="submit" 
                                    class="bg-green-600 text-white py-3 px-8 rounded-lg hover:bg-green-700 transition flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Agregar al Carrito
                            </button>
                            
                            <a href="{{ route('catalogo') }}" 
                               class="bg-gray-200 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-300 transition">
                                Seguir Comprando
                            </a>
                        </div>
                    </form>
                    
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
                    * Nota: La API solo proporciona una imagen por producto. Para cumplir con el requisito de 3 imágenes, mostramos la misma imagen.
                </p>
            </div>
        </div>
    @endif
</div>
@endsection