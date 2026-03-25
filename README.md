# Proyecto Laravel - Catálogo con Carrito, Autenticación y Pedidos

## America Sofia Santillan Medina

## Descripción
Sitio web desarrollado con Laravel que incluye:
- Catálogo de productos desde Fake Store API
- Carrito de compras con sesiones
- Autenticación de usuarios con tokens
- Gestión de pedidos por usuario

## Características

### Públicas (sin autenticación)
- Ver catálogo de productos
- Ver detalle de producto con 3 imágenes
- Agregar productos al carrito
- Actualizar cantidades en carrito
- Eliminar productos del carrito
- Vaciar carrito

### Privadas (requieren autenticación)
- Registro de usuarios
- Inicio de sesión
- Ver perfil personal
- Editar datos personales
- Actualizar imagen de perfil
- Cambiar contraseña
- Cerrar sesión
- **Crear pedido a partir del carrito**
- **Listar todos los pedidos**
- **Ver detalle de un pedido**
- **Cancelar pedido (si está pendiente)**

## Tecnologías usadas
- Laravel 10
- Tailwind CSS
- Fake Store API (productos)
- Platzi API (autenticación)
