@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Catálogo de Productos</h1>
    
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($productos as $producto)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col h-full">
                    <a href="{{ route('producto.detalle', $producto['id']) }}" class="block p-4">
                        <img src="{{ $producto['image'] }}" 
                             alt="{{ $producto['title'] }}"
                             class="w-full h-48 object-contain">
                    </a>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <a href="{{ route('producto.detalle', $producto['id']) }}" class="hover:text-blue-600">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ $producto['title'] }}
                            </h2>
                        </a>
                        
                        <p class="text-gray-600 mb-4 line-clamp-2 flex-grow">
                            {{ $producto['description'] }}
                        </p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-blue-600">
                                ${{ number_format($producto['price'], 2) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                ★ {{ $producto['rating']['rate'] }} ({{ $producto['rating']['count'] }})
                            </span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('producto.detalle', $producto['id']) }}" 
                               class="flex-1 text-center bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300 transition text-sm">
                                Ver Detalle
                            </a>
                            
                            <form action="{{ route('carrito.agregar') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="id" value="{{ $producto['id'] }}">
                                <button type="submit" 
                                        class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition text-sm flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Agregar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection