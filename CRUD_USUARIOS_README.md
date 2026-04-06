# CRUD de Usuarios - Guía de Uso

## ✅ Implementación Completada

Se ha implementado un **CRUD completo de usuarios en el dashboard** con protección de roles. Solo usuarios **admin** pueden acceder.

---

## 🚀 Cómo Usar

### 1. Iniciar Sesión como Admin
```
Email: admin@example.com
Contraseña: admin123
```

### 2. Acceder al Dashboard
Una vez autenticado, serás redirigido al panel de control donde podrás:

#### 📊 **Ver Usuarios**
- Tabla con todos los usuarios registrados
- Columnas: ID, Nombre, Email, Rol
- Botón "Recargar" para actualizar la lista

#### ➕ **Crear Usuario**
1. Haz clic en "Crear Usuario"
2. Completa el formulario:
   - **Nombre**: Nombre completo
   - **Email**: Correo único
   - **Contraseña**: Mínimo 6 caracteres
   - **Rol**: Usuario o Admin
3. Haz clic en "Crear"

#### ✏️ **Editar Usuario**
1. Haz clic en el icono ✏️ en la fila del usuario
2. Modifica los datos (contraseña es opcional)
3. Haz clic en "Actualizar"

#### 🗑️ **Eliminar Usuario**
1. Haz clic en el icono 🗑️ en la fila del usuario
2. Confirma la eliminación

---

## 🔐 Seguridad

- **Solo Admins pueden acceder**: Las rutas `/api/users/*` están protegidas con middleware `is.admin`
- **Autenticación Sanctum**: Se usa tokens Bearer para autenticación
- **Validación**: Se validan todos los campos (email único, contraseña mínimo 6 caracteres)

---

## 📋 Usuarios Disponibles

| Email | Contraseña | Rol |
|-------|-----------|-----|
| **admin@example.com** | admin123 | admin ✅ (Úsalo para probar) |
| user@example.com | user123 | user |

---

## 🛠️ Stack Tecnológico

**Backend:**
- Laravel 11
- PostgreSQL
- Sanctum (autenticación)

**Frontend:**
- Vue 3 (Composition API)
- Tailwind CSS
- Axios

---

## 📝 Cambios Principales

### Backend
- ✅ Campo `role` agregado a tabla `users`
- ✅ Middleware `IsAdmin` para validación de permisos
- ✅ Rutas CRUD protegidas
- ✅ UserController completo (index, show, store, update, destroy)

### Frontend
- ✅ Dashboard completamente rediseñado con CRUD funcional
- ✅ Modal reutilizable para crear y editar
- ✅ Tabla de usuarios con acciones
- ✅ Manejo de errores y validaciones
- ✅ Estilos modernos con Tailwind

---

## 🎯 Próximas Mejoras (Sugerencias)

- [ ] Paginación de usuarios
- [ ] Búsqueda/filtro de usuarios
- [ ] Exportar usuarios a CSV
- [ ] Resetear contraseña por email
- [ ] Historial de cambios/auditoría
- [ ] Roles más específicos (editor, viewer, etc.)

