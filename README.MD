# FullStack2

## Descripción
Aplicación Fullstack con **Laravel 11** en el backend, **Vue 3 + Vite** en el frontend y **PostgreSQL** como base de datos. El proyecto está montado con **Docker** y usa un contenedor para `backend` y otro para `postgres`.

## Tecnologías
- Laravel 11
- Vue 3 + Vite
- PostgreSQL
- Docker

## Requisitos
- Docker y Docker Compose instalados
- Node.js/npm (para frontend)

## Estructura principal
- `backend/` - aplicación Laravel
- `frontend/frontend/` - aplicación Vue 3
- `docker-compose.yml` - orquesta backend y postgres

## Inicio rápido

### 1. Levantar los contenedores

```bash
docker compose up -d --build
```

### 2. Ejecutar migraciones y seeders

```bash
cd backend
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=TestUsersSeeder
```

> Si ya tienes la base instalada, solo ejecuta `php artisan migrate`.

### 3. Iniciar frontend

```bash
cd frontend/frontend
npm install
npm run dev
```

## URLs
- Frontend: `http://localhost:5173`
- Backend API: `http://localhost:8000/api`
- Swagger: `http://localhost:8000/swagger.html`

## Base de datos
Sí, el proyecto está configurado para usar **PostgreSQL**.
La conexión está definida en `backend/.env` como:

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=fullstack_db
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

## Usuarios de prueba
| Usuario | Contraseña | Rol |
| --- | --- | --- |
| admin@example.com | admin123 | admin |
| user@example.com | user123 | user |

## Comportamiento de roles
- **Admin**: puede ver y gestionar todos los usuarios desde el dashboard.
- **Usuario regular**: solo puede ver su propio perfil.

## API principal
- `POST /api/login`
- `GET /api/users`
- `GET /api/users/{id}`
- `GET /api/me`
- `POST /api/users` (solo admin)
- `PUT /api/users/{id}` (solo admin)
- `DELETE /api/users/{id}` (solo admin)

## Notas importantes
- El backend corre en el contenedor `fullstack_backend` y la base de datos en `fullstack_postgres`.
- El frontend vive en `frontend/frontend/`, no en `frontend/` directamente.
- El dashboard hace auth con token Bearer y guarda el token en `localStorage`.
- Si necesitas reconstruir el proyecto desde cero, ejecuta `docker compose down -v` y luego `docker compose up -d --build`.

## Uso diario
1. Abre el frontend en `http://localhost:5173`
2. Inicia sesión con el usuario admin: `admin@example.com` / `admin123`
3. Administra usuarios desde el dashboard

## Extras
- Swagger disponible en `http://localhost:8000/swagger.html`
- El endpoint `/api/me` devuelve el usuario autenticado
