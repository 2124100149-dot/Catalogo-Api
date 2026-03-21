\# Proyecto en Laravel - Catálogo con Carrito y Autenticación



\## America Sofia Santillan Medina



\## Descripción

Sitio web desarrollado con Laravel que incluye catálogo de productos, carrito de compras y autenticación de usuarios.



\## Características



\### Públicas (sin iniciar sesión)

\- Ver catálogo de productos

\- Ver detalle de producto con 3 imágenes

\- Agregar productos al carrito

\- Actualizar cantidades en carrito

\- Eliminar productos del carrito

\- Vaciar carrito



\### Privadas (requieren iniciar sesión)

\- Registro de usuarios

\- Inicio de sesión

\- Ver perfil personal

\- Editar datos personales

\- Actualizar imagen de perfil

\- Cambiar contraseña

\- Cerrar sesión



\## Tecnologías usadas

\- Laravel 10

\- Tailwind CSS

\- Fake Store API (productos)

\- Platzi API (autenticación)



\## API usadas



\### Productos (pública)

\- URL: https://fakestoreapi.com

\- GET /products - Lista productos

\- GET /products/{id} - Detalle producto



\### Autenticación (cual requiere token)

\- URL: https://api.escuelajs.co/api/v1

\- POST /users - Registrar usuario

\- POST /auth/login - Iniciar sesión

\- GET /auth/profile - Ver perfil

\- PUT /users/{id} - Actualizar usuario



\## Carrito de compras

El carrito se guarda en la sesión del navegador. No usa base de datos.



\## Autenticación

El token se guarda en la sesión al iniciar sesión. Las operaciones de perfil requieren este token.



