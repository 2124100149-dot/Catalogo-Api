@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Mi Perfil</h1>
    
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
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-8 text-center">
                    <div class="relative inline-block">
                        <img src="{{ $usuario['avatar'] ?? 'https://ui-avatars.com/api/?background=ffffff&color=0D8ABC&size=120&name=' . urlencode($usuario['name']) }}" 
                             alt="Avatar"
                             class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                    </div>
                    <h2 class="text-white text-xl font-bold mt-4">{{ $usuario['name'] }}</h2>
                    <p class="text-blue-100 text-sm">{{ $usuario['email'] }}</p>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center text-gray-600 mb-3">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-sm">Miembro desde: {{ date('d/m/Y') }}</span>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full mt-4 bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Datos Personales</h3>
                </div>
                
                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre Completo</label>
                        <input type="text" 
                               name="name" 
                               value="{{ $usuario['name'] }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                        <input type="email" 
                               name="email" 
                               value="{{ $usuario['email'] }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <button type="submit" 
                            class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition font-medium">
                        Actualizar Datos
                    </button>
                </form>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Imagen de Perfil</h3>
                </div>
                
                <form action="{{ route('perfil.avatar') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">URL de la imagen</label>
                        <input type="url" 
                               name="avatar" 
                               value="{{ $usuario['avatar'] ?? '' }}"
                               placeholder="https://ejemplo.com/imagen.jpg"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-gray-500 text-xs mt-1">Ejemplo: https://api.lorem.space/image/face?w=150&h=150</p>
                    </div>
                    
                    <button type="submit" 
                            class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition font-medium">
                        Actualizar Imagen
                    </button>
                </form>
                
                <div class="mt-4 pt-4 border-t">
                    <p class="text-sm text-gray-500 mb-2">Vista previa:</p>
                    <img src="{{ $usuario['avatar'] ?? 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . urlencode($usuario['name']) }}" 
                         alt="Preview"
                         class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6-4h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2zm10-4V8a4 4 0 00-8 0v3h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Cambiar Contraseña</h3>
                </div>
                
                <form action="{{ route('perfil.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña Actual</label>
                        <input type="password" 
                               name="current_password" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nueva Contraseña</label>
                        <input type="password" 
                               name="new_password" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        <p class="text-gray-500 text-xs mt-1">Mínimo 6 caracteres</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Confirmar Nueva Contraseña</label>
                        <input type="password" 
                               name="new_password_confirmation" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    
                    <button type="submit" 
                            class="bg-red-600 text-white py-2 px-6 rounded-lg hover:bg-red-700 transition font-medium">
                        Cambiar Contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection