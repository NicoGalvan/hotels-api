# **Hotel Management API**

Este proyecto es una **API RESTful** desarrollada con **Laravel 10** para la gestión de hoteles, tipos de habitaciones, acomodaciones y más.

---

## **📂 Modelo de base de datos**

![Modelo de base de datos](https://github.com/user-attachments/assets/b5421731-92ca-48dc-a5f8-c4a89e6dd97d)

---

## **🛠️ Requisitos previos**

Asegúrate de que tu entorno cumpla con los siguientes requisitos antes de comenzar:

- **[Laravel](https://laravel.com/docs):** 10.x
- **PHP:** 8.1 o superior
- **[Composer](https://getcomposer.org/):** 2.x
- **PostgreSQL:** 12 o superior
- **[Node.js](https://nodejs.org/)**
- **[Laragon](https://laragon.org/):** o cualquier entorno de desarrollo local compatible con PHP y PostgreSQL.

---

## **⚙️ Configuración del proyecto**

Sigue estos pasos para configurar y ejecutar el proyecto localmente.

### 1. Clonar el repositorio

```bash
git clone https://github.com/NicoGalvan/hotels-api.git
cd hotels-api
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Crear el archivo .env

Crea un archivo .env en la raíz del proyecto. Puedes duplicar el archivo de ejemplo:

```bash
cp .env.example .env
```

Luego, actualiza las variables del archivo .env con la configuración de tu base de datos y otros valores necesarios:

```env
APP_NAME=Hotel Management API
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=hotels
DB_USERNAME=postgres
DB_PASSWORD=tu-contraseña
```
### 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5. Configurar la base de datos

Asegúrate de que PostgreSQL esté corriendo y de crear una base de datos llamada hotels:

```sql
CREATE DATABASE hotels;
```
### 6. Ejecutar migraciones y seeders

Ejecuta las migraciones para crear las tablas y los seeders para poblar datos iniciales:
```bash
php artisan migrate --seed
```

### 7. Iniciar el servidor de desarrollo
```bash
php artisan serve
```
El proyecto estará disponible en http://localhost:8000.

### 8. Probar la API
Usa herramientas como Postman o cURL para probar la API. Por ejemplo:
#### Listar hoteles
```bash
GET http://localhost:8000/api/hotels
```
#### Crear un hotel
```bash
POST http://localhost:8000/api/hotels
Content-Type: application/json

{
    "name": "Hotel Example",
    "address": "123 Example Street",
    "city_id": 1,
    "nit": "123456789",
    "max_rooms": 100
}
```
### Probar api desplegada
Puedes utilizar la API sin ejecutar estos pasos mediante la API que se encuentra en línea en el siguiente dominio: https://hotels-api-production.up.railway.app/api/
```bash
GET https://hotels-api-production.up.railway.app/api/hotels
```
### contacto
Si tienes preguntas o problemas, no dudes en abrir un issue en este repositorio o contactarme a nicogalvan1@hotmail.com.
