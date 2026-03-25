<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Catálogo de Productos')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-blue-600">
                        Mi Catálogo
                    </a>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
                        <a href="{{ route('nosotros') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Nosotros</a>
                        <a href="{{ route('catalogo') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Catálogo</a>
                        <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Contacto</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @php
                        $usuario = session()->get('user_data');
                    @endphp
                    
                    @if($usuario)
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <img src="{{ $usuario['avatar'] ?? 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . urlencode($usuario['name']) }}" 
                                     alt="Avatar"
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-gray-700">{{ $usuario['name'] }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden group-hover:block z-50">
                                <a href="{{ route('perfil') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Mi Perfil</a>
                                <a href="{{ route('pedidos.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Mis Pedidos</a>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Registrarse
                        </a>
                    @endif
                    
                    <div class="flex items-center">
                        <a href="{{ route('carrito') }}" class="relative">
                            <svg class="w-6 h-6 text-gray-700 hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            
                            @php
                                $carrito = session()->get('carrito', []);
                                $totalItems = 0;
                                foreach($carrito as $item) {
                                    $totalItems += $item['cantidad'];
                                }
                            @endphp
                            
                            @if($totalItems > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $totalItems }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} America Sofia Santillan Medina
            </p>
        </div>
    </footer>
</body>
</html>