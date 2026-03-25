@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Carrito de Compras</h1>
    
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
    
    @if(empty($carrito))
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Tu carrito está vacío</h2>
            <p class="text-gray-500 mb-6">¡Explora nuestro catálogo y encuentra productos increíbles!</p>
            <a href="{{ route('catalogo') }}" 
               class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition">
                Ver Catálogo
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="carrito-body">
                    @php $total = 0; @endphp
                    @foreach($carrito as $id => $item)
                        @php 
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        @endphp
                        <tr id="producto-{{ $id }}" data-id="{{ $id }}" data-precio="{{ $item['precio'] }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" class="w-16 h-16 object-contain mr-4">
                                    <span class="text-sm text-gray-900">{{ $item['nombre'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 precio-unitario">
                                ${{ number_format($item['precio'], 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <input type="number" 
                                       value="{{ $item['cantidad'] }}" 
                                       min="1"
                                       class="w-20 px-2 py-1 border rounded cantidad-input"
                                       data-id="{{ $id }}">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 subtotal">
                                ${{ number_format($subtotal, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('carrito.eliminar', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-semibold">Total:</td>
                        <td class="px-6 py-4 text-lg font-bold text-blue-600" id="total-carrito">
                            ${{ number_format($total, 2) }}
                        </td>
                        <td class="px-6 py-4"></td>
                    </tr>
                </tfoot>
            </table>
            
            <div class="p-6 flex justify-between items-center">
                <a href="{{ route('catalogo') }}" 
                   class="bg-gray-200 text-gray-700 py-2 px-6 rounded-lg hover:bg-gray-300 transition">
                    Seguir Comprando
                </a>
                
                <div class="space-x-4">
                    @if(!empty($carrito))
                        @php
                            $usuario = session()->get('user_data');
                        @endphp
                        
                        @if($usuario)
                            <form action="{{ route('pedidos.store') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition font-medium">
                                     Finalizar Compra
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" 
                               class="bg-yellow-600 text-white py-2 px-6 rounded-lg hover:bg-yellow-700 transition inline-block font-medium">
                                 Inicia Sesión para Comprar
                            </a>
                        @endif
                    @endif
                    
                    <form action="{{ route('carrito.vaciar') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 text-white py-2 px-6 rounded-lg hover:bg-red-700 transition"
                                onclick="return confirm('¿Estás seguro de vaciar el carrito?')">
                            Vaciar Carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadInputs = document.querySelectorAll('.cantidad-input');
    
    cantidadInputs.forEach(input => {
        input.addEventListener('change', function() {
            const id = this.dataset.id;
            const nuevaCantidad = parseInt(this.value);
            
            if (nuevaCantidad < 1) {
                this.value = 1;
                actualizarCantidad(id, 1);
            } else {
                actualizarCantidad(id, nuevaCantidad);
            }
        });
    });
    
    function actualizarCantidad(id, cantidad) {
        const fila = document.getElementById(`producto-${id}`);
        const precioUnitario = parseFloat(fila.dataset.precio);

        const nuevoSubtotal = precioUnitario * cantidad;
        
        const subtotalCell = fila.querySelector('.subtotal');
        subtotalCell.textContent = `$${nuevoSubtotal.toFixed(2)}`;
        
        actualizarTotalGeneral();
        
        fetch(`/carrito/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cantidad: cantidad })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Error al actualizar el carrito');
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    function actualizarTotalGeneral() {
        let total = 0;
        const subtotales = document.querySelectorAll('.subtotal');
        
        subtotales.forEach(subtotal => {
            const valor = parseFloat(subtotal.textContent.replace('$', ''));
            total += valor;
        });
        
        const totalElement = document.getElementById('total-carrito');
        totalElement.textContent = `$${total.toFixed(2)}`;
    }
});
</script>
@endsection