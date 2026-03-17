@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Sobre Nosotros</h1>
        
        <div class="prose max-w-none">
            <p class="text-lg text-gray-700 mb-4">
                Somos una empresa dedicada a ofrecer los mejores productos a nuestros clientes. 
                Nuestra misión es proporcionar artículos de alta calidad con el mejor servicio.
            </p>
            
            <h2 class="text-2xl font-semibold mt-8 mb-4">Nuestra Historia</h2>
            <p class="text-gray-700 mb-4">
                Fundada en 2000, nuestra empresa ha crecido gracias a la confianza de nuestros clientes.
                Nos especializamos en traer los mejores productos del mercado con precios competitivos.
            </p>
            
            <h2 class="text-2xl font-semibold mt-8 mb-4">¿Por qué elegirnos?</h2>
            <ul class="list-disc pl-6 text-gray-700">
                <li class="mb-2">Productos de alta calidad</li>
                <li class="mb-2">Atención personalizada</li>
                <li class="mb-2">Envíos a todo el país</li>
                <li class="mb-2">Garantía de satisfacción</li>
            </ul>
        </div>
    </div>
</div>
@endsection