@extends('layouts.app')

@section('title', 'Detalle Pedido #' . $pedido['id'])

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="mb-4">
        <a href="{{ route('pedidos.index') }}" class="text-blue-600 hover:text-blue-800">
            ← Volver a mis pedidos
        </a>
    </div>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Pedido #{{ $pedido['id'] }}</h1>
    
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
    
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Información del Pedido</h2>
                
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Número de Pedido</p>
                        <p class="font-medium">#{{ $pedido['id'] }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">Fecha</p>
                        <p class="font-medium">{{ $pedido['fecha'] }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">Estado</p>
                        @if($pedido['estado'] == 'pendiente_pago')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold inline-block">
                                 Pendiente de Pago
                            </span>
                        @elseif($pedido['estado'] == 'pagado')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold inline-block">
                                 Pagado
                            </span>
                        @elseif($pedido['estado'] == 'cancelado')
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold inline-block">
                                 Cancelado
                            </span>
                        @endif
                    </div>
                    
                    @if(isset($pedido['transaction_id']) && $pedido['transaction_id'])
                        <div>
                            <p class="text-sm text-gray-500">Número de Transacción</p>
                            <p class="font-mono text-sm bg-gray-100 p-2 rounded break-all">{{ $pedido['transaction_id'] }}</p>
                        </div>
                    @endif
                    
                    @if(isset($pedido['fecha_pago']) && $pedido['fecha_pago'])
                        <div>
                            <p class="text-sm text-gray-500">Fecha de Pago</p>
                            <p class="font-medium">{{ $pedido['fecha_pago'] }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <p class="text-sm text-gray-500">Total</p>
                        <p class="text-2xl font-bold text-blue-600">${{ number_format($pedido['total'], 2) }}</p>
                    </div>
                    
                    @if($pedido['estado'] == 'pendiente_pago')
                        <div class="pt-4 space-y-2">
                            <a href="{{ route('pagos.show', $pedido['id']) }}" 
                               class="block w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition text-center">
                                 Pagar Ahora
                            </a>
                            
                            <form action="{{ route('pedidos.cancel', $pedido['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition"
                                        onclick="return confirm('¿Estás seguro de cancelar este pedido?')">
                                    Cancelar Pedido
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Productos</h2>
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        32
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cantidad</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pedido['productos'] as $producto)
                            <tr>
                                <td class="px-4 py-4">
                                    <span class="text-sm text-gray-900">{{ $producto['nombre'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                    ${{ number_format($producto['precio'], 2) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                    {{ $producto['cantidad'] }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                    ${{ number_format($producto['subtotal'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-right font-semibold">Total:</td>
                            <td class="px-4 py-4 text-lg font-bold text-blue-600">
                                ${{ number_format($pedido['total'], 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection