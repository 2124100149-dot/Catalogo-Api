@extends('layouts.app')

@section('title', 'Pagar Pedido #' . $pedido['id'])

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="mb-4">
        <a href="{{ route('pedidos.show', $pedido['id']) }}" class="text-blue-600 hover:text-blue-800">
            ← Volver al pedido
        </a>
    </div>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Realizar Pago</h1>
    
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Resumen del Pedido</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Número de pedido:</span>
                    <span class="font-medium">#{{ $pedido['id'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Fecha:</span>
                    <span class="font-medium">{{ $pedido['fecha'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Productos:</span>
                    <span class="font-medium">{{ count($pedido['productos']) }} items</span>
                </div>
                <div class="border-t pt-3 mt-3">
                    <div class="flex justify-between">
                        <span class="text-lg font-bold text-gray-800">Total a pagar:</span>
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($pedido['total'], 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Método de Pago</h2>
            
            <div class="text-center mb-6">
                <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" 
                     alt="PayPal" 
                     class="inline-block h-12 mb-4">
                <p class="text-gray-600">Paga de forma segura con PayPal</p>
                <p class="text-sm text-gray-500 mt-2">Entorno de pruebas (Sandbox)</p>
            </div>
            
            <form action="{{ route('pagos.procesar', $pedido['id']) }}" method="POST">
                @csrf
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-sm text-yellow-800 mb-2">
                        <strong> Modo de pruebas:</strong>
                    </p>
                    <p class="text-xs text-yellow-700">
                        Usa estas credenciales de prueba:<br>
                        <strong>Email:</strong> xxxxxxx@gmail.com<br>
                        <strong>Contraseña:</strong> ********<br>
                        * No son cargos reales.
                    </p>
                </div>
                
                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition font-medium flex items-center justify-center">
                    Proceder al Pago con PayPal
                </button>
            </form>
        </div>
    </div>
</div>
@endsection