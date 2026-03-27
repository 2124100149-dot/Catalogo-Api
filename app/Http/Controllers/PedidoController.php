<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller
{
    public function index()
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $pedidos = Session::get('pedidos', []);
        
        return view('pedidos.index', compact('pedidos'));
    }

    public function store(Request $request)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para finalizar la compra');
        }

        $carrito = Session::get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'El carrito está vacío');
        }

        $usuario = Session::get('user_data');
        
        $total = 0;
        $productosPedido = [];
        
        foreach ($carrito as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
            $productosPedido[] = [
                'id' => $item['id'],
                'nombre' => $item['nombre'],
                'precio' => $item['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $subtotal
            ];
        }
        
        $pedido = [
            'id' => rand(1000, 9999),
            'cliente_id' => $usuario['id'],
            'cliente_nombre' => $usuario['name'],
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => 'pendiente_pago',
            'total' => $total,
            'productos' => $productosPedido,
        ];
        
        $pedidos = Session::get('pedidos', []);
        array_unshift($pedidos, $pedido);
        Session::put('pedidos', $pedidos);
        
        Session::forget('carrito');
        
        return redirect()->route('pedidos.show', $pedido['id'])->with('success', 'Pedido creado exitosamente. Número: ' . $pedido['id']);
    }

    public function show($id)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $pedidos = Session::get('pedidos', []);
        $pedido = null;
        
        foreach ($pedidos as $p) {
            if ($p['id'] == $id) {
                $pedido = $p;
                break;
            }
        }
        
        if (!$pedido) {
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado');
        }
        
        return view('pedidos.show', compact('pedido'));
    }

    public function cancel($id)
    {
        if (!Session::has('auth_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $pedidos = Session::get('pedidos', []);
        $pedidoEncontrado = false;
        
        foreach ($pedidos as $key => $pedido) {
            if ($pedido['id'] == $id) {
                if ($pedido['estado'] == 'cancelado') {
                    return back()->with('error', 'Este pedido ya está cancelado');
                }
                
                if ($pedido['estado'] == 'pagado') {
                    return back()->with('error', 'No se puede cancelar un pedido ya pagado');
                }
                
                $pedidos[$key]['estado'] = 'cancelado';
                $pedidoEncontrado = true;
                break;
            }
        }
        
        if (!$pedidoEncontrado) {
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado');
        }
        
        Session::put('pedidos', $pedidos);
        
        return redirect()->route('pedidos.show', $id)->with('success', 'Pedido cancelado exitosamente');
    }
}