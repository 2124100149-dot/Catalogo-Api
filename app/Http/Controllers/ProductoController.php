<?php
// foking sofia
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductoController extends Controller
{
    public function index()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        
        if ($response->successful()) {
            $productos = $response->json();
            return view('catalogo', compact('productos'));
        }
        
        return view('catalogo', ['error' => 'No se pudieron cargar los productos']);
    }

    public function show($id)
{
    $response = Http::get("https://fakestoreapi.com/products/{$id}");
    
    if ($response->successful()) {
        $producto = $response->json();
        
        // Crear un array de 3 imágenes (usando la misma imagen)
        $producto['imagenes'] = [
            $producto['image'],
            $producto['image'],
            $producto['image']
        ];
        
        return view('detalle', compact('producto'));
    }
    
    return view('detalle', ['error' => 'Producto no encontrado']);
    }
}