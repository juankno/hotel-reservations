<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Hotel Reservations

Hotel Reservations es una aplicación para gestionar reservas de hotel de manera eficiente y sencilla.

## Requisitos del sistema

- PHP >= 8.0
- Composer
- MySQL
- Node.js y npm

## Instalación

Sigue los pasos a continuación para configurar el proyecto en tu entorno local:

1. Clona el repositorio:
   ```bash
   git clone https://github.com/juankno/hotel-reservations.git
   cd hotel-reservations
   ```

2. Instala las dependencias de PHP:
   ```bash
   composer install
   ```

3. Instala las dependencias de Node.js:
   ```bash
   npm install
   ```

4. Copia el archivo de entorno y configura las variables necesarias:
   ```bash
   cp .env.example .env
   ```

   Edita el archivo `.env` para configurar la conexión a la base de datos y otros parámetros.

5. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

6. Ejecuta las migraciones y seeders para configurar la base de datos:
   ```bash
   php artisan migrate --seed
   ```

7. Compila los assets del frontend:
   ```bash
   npm run dev
   ```

8. Inicia el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

   La aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

## Características

- Gestión de reservas de habitaciones.
- Configuración de usuarios y roles.
- Reportes de ocupación y disponibilidad.

## Contribuciones

Si deseas contribuir al proyecto, por favor sigue los pasos a continuación:

1. Haz un fork del repositorio.
2. Crea una rama para tu funcionalidad (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -m "Descripción de los cambios"`).
4. Envía un pull request.

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).
