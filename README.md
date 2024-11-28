# Task API

API para gestionar tareas con autenticación JWT utilizando Laravel.

## Requisitos

- PHP 8.1 o superior
- Composer
- Laravel 10.x o superior
- Base de datos (MySQL, SQLite, etc.)

## Instalación

Sigue estos pasos para instalar y configurar la API:

1. **Clonar el repositorio**

   Abre tu terminal y ejecuta el siguiente comando para clonar el repositorio:

   ```bash
   git clone https://github.com/abitae/task.git
   cd task
   composer install
   cp .env.example .env

2. **Base de datos**
    Configura la base de datos en el archivo `.env`. Por ejemplo, para MySQL:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña

3. **Crear la clave de aplicación**
    Ejecuta el siguiente comando para generar la clave de aplicación:
    php artisan key:generate
4. **Instalar el paquete JWT**
    Ejecuta el siguiente comando para instalar el paquete JWT:
    composer require tymon/jwt-auth
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    php artisan jwt:secret
    php artisan migrate:fresh --seed

5. **Iniciar el Servidor**
    Ejecuta el siguiente comando para Iniciar el Servidor:
    php artisan serve

6. **Autenticación**
    User : abel.arana@hotmail.com
    pass: lobomalo123

7. **   eso es todo amigos**