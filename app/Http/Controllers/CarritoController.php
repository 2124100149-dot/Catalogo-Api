<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    public function agregar(Request $request)
{
    $id = $request->id;
    
    $response = Http::get("https://fakestoreapi.com/products/{$id}");
    
    if ($response->successful()) {
        $producto = $response->json();
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'id' => $producto['id'],
                'nombre' => $producto['title'],
                'precio' => $producto['price'],
                'imagen' => $producto['image'],
                'cantidad' => 1
            ];
        }
        
        session()->put('carrito', $carrito);
        
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }
    
    return redirect()->back()->with('error', 'Error al agregar producto');
}

    public function actualizar(Request $request, $id)
{
    $carrito = session()->get('carrito', []);
    
    if (isset($carrito[$id])) {
        $carrito[$id]['cantidad'] = $request->cantidad;
        session()->put('carrito', $carrito);
        
        return response()->json([
            'success' => true,
            'subtotal' => $carrito[$id]['precio'] * $request->cantidad
        ]);
    }
    
    return response()->json(['success' => false], 404);
}

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
            return redirect()->route('carrito')->with('success', 'Producto eliminado');
        }
        
        return redirect()->route('carrito')->with('error', 'Producto no encontrado');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito')->with('success', 'Carrito vaciado');
    }
}