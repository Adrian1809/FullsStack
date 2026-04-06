<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 🔓 Rutas públicas
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.register');

// 🔒 Rutas protegidas con token
Route::middleware('auth:sanctum')->group(function () {

    // Ver usuarios (cualquier usuario autenticado)
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    // Gestión de usuarios (requiere rol admin)
    Route::middleware('is.admin')->group(function () {
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });

    // Obtener usuario actual
    Route::get('/me', [UserController::class, 'me']);

    });
/*Route::middleware('auth:sanctum')->get('/users', function () {
    return User::select('id', 'name', 'email')->get();
});

    // Aquí después agregaremos:
    // - CRUD de usuarios
    */
