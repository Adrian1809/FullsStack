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

    // Obtener usuario autenticado
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    });
/*Route::middleware('auth:sanctum')->get('/users', function () {
    return User::select('id', 'name', 'email')->get();
});

    // Aquí después agregaremos:
    // - CRUD de usuarios
    */
