@extends('layouts.app')

@section('title', 'Mis Pedidos')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Mis Pedidos</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    @if(empty($pedidos))
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">No tienes pedidos</h2>
            <p class="text-gray-500 mb-6">¡Realiza tu primera compra!</p>
            <a href="{{ route('catalogo') }}" 
               class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition">
                Ver Catálogo
            </a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach($pedidos as $pedido)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    Pedido #{{ $pedido['id'] }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    Fecha: {{ $pedido['fecha'] }}
                                </p>
                            </div>
                            <div>
                                @if($pedido['estado'] == 'pendiente_pago')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                        ⏳ Pendiente de Pago
                                    </span>
                                @elseif($pedido['estado'] == 'pagado')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                        ✅ Pagado
                                    </span>
                                @elseif($pedido['estado'] == 'cancelado')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                                        ❌ Cancelado
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <p class="text-gray-600">
                                    <span class="font-semibold">Total:</span> 
                                    <span class="text-xl font-bold text-blue-600">${{ number_format($pedido['total'], 2) }}</span>
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ count($pedido['productos']) }} producto(s)
                                </p>
                                @if(isset($pedido['transaction_id']) && $pedido['transaction_id'])
                                    <p class="text-xs text-gray-400 mt-1">
                                        Transacción: {{ substr($pedido['transaction_id'], 0, 20) }}...
                                    </p>
                                @endif
                            </div>
                            <a href="{{ route('pedidos.show', $pedido['id']) }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Ver Detalle
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection