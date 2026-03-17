@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Catálogo de Productos</h1>
    
    @if(isset($error))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ $error }}
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($productos as $producto)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                
                    <img src="{{ $producto['image'] }}" 
                         alt="{{ $producto['title'] }}"
                         class="w-full h-48 object-contain p-4">
                    
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $producto['title'] }}
                        </h2>
                        
                        <p class="text-gray-600 mb-4 line-clamp-2">
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
                        
                        <a href="{{ route('producto.detalle', $producto['id']) }}" 
                           class="block w-full text-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                            Ver Detalle
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection