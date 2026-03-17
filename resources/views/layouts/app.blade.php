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