# Fullstack App (Laravel + Vue + PostgreSQL)

## Tecnologías
- Laravel 11
- Vue 3 + Vite
- PostgreSQL
- Docker

---

## ⚙️Instalación

### 1. Clonar repositorio

```bash
git clone <repo>
cd FullStack2
```
---
### 2. Levantar Docker
```bash
docker compose up -d --build
```
---
### 3. Entrar al backend
```bash
docker exec -it fullstack_backend sh
```
---
### 4. Instalar Laravel
```bash
composer install
php artisan key:generate
php artisan migrate
```
---
### 5. Levantar servidor
```bash
php artisan serve --host=0.0.0.0 --port=8000
```
---
### 6. Frontend
```bash
cd frontend
npm install
npm run dev
```
---
### Accesos
- Frontend: http://localhost:5173
- Backend: http://localhost:8000
- Swagger: http://localhost:8000/swagger.html
---
### Credenciales
email: admin@test.com
password: 123456

### API
POST/api/login

### Usuarios
- GET /api/users
- POST /api/users
- PUT /api/users/{id}
- DELETE /api/users/{id}

### Swagger
http://localhost:8000/swagger.html

---

# PARTE 3 — Seeder (para que no dependan de Tinker)

---

## Crear seeder:

```bash
php artisan make:seeder UserSeeder
```
### Código
```bash
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin',
    'email' => 'admin@test.com',
    'password' => Hash::make('123456')
]);
```
### Ejecutar
php artisan db:seed

### Notas
- Todas las rutas protegidas requieren token Bearer
- El token se obtiene desde el endpoint /api/login
- Se incluye colección de Postman para pruebas (opcional)
