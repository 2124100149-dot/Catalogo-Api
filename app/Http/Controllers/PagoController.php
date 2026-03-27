<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PagoController extends Controller
{
    public function show($pedidoId)
    {
        // Verificar autenticación
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $pedidos = Session::get('pedidos', []);
        $pedido = null;
        
        foreach ($pedidos as $p) {
            if ($p['id'] == $pedidoId) {
                $pedido = $p;
                break;
            }
        }
        
        if (!$pedido) {
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado');
        }
        
        $estadoPedido = $pedido['estado'] ?? 'pendiente_pago';
        $tieneTransaccion = isset($pedido['transaction_id']) && !empty($pedido['transaction_id']);
        
        if ($tieneTransaccion || $estadoPedido == 'pagado') {
            return redirect()->route('pedidos.show', $pedidoId)->with('error', 'Este pedido ya fue pagado');
        }
        
        if ($estadoPedido == 'cancelado') {
            return redirect()->route('pedidos.show', $pedidoId)->with('error', 'Este pedido ya fue cancelado');
        }
        
        return view('pagos.pagar', compact('pedido'));
    }

    public function procesar(Request $request, $pedidoId)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $pedidos = Session::get('pedidos', []);
        $pedidoIndex = null;
        $pedido = null;
        
        foreach ($pedidos as $index => $p) {
            if ($p['id'] == $pedidoId) {
                $pedidoIndex = $index;
                $pedido = $p;
                break;
            }
        }
        
        if (!$pedido) {
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado');
        }
        
        $estadoPedido = $pedido['estado'] ?? 'pendiente_pago';
        $tieneTransaccion = isset($pedido['transaction_id']) && !empty($pedido['transaction_id']);
        
        if ($tieneTransaccion || $estadoPedido == 'pagado') {
            return redirect()->route('pedidos.show', $pedidoId)->with('error', 'Este pedido ya fue pagado');
        }
        
        if ($estadoPedido == 'cancelado') {
            return redirect()->route('pedidos.show', $pedidoId)->with('error', 'Este pedido ya fue cancelado');
        }
        
        $transactionId = 'PAYPAL-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);
        $fechaPago = date('Y-m-d H:i:s');
        
        $pedidos[$pedidoIndex]['estado'] = 'pagado';
        $pedidos[$pedidoIndex]['transaction_id'] = $transactionId;
        $pedidos[$pedidoIndex]['fecha_pago'] = $fechaPago;
        
        Session::put('pedidos', $pedidos);
        
        return redirect()->route('pedidos.show', $pedidoId)->with('success', 'Pago realizado exitosamente! Número de transacción: ' . $transactionId);
    }
    
    public function webhook(Request $request)
    {
        return response()->json(['message' => 'Webhook recibido'], 200);
    }
}