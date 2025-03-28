<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PersonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    //Registrar persona con cuenta de usuario   
    Route::post('/persona/guardar-persona-user', [PersonaController::class, 'funGuardarPersonaUser']);
    //Asignar cuenta de user a persona
    Route::post('/persona/{id}/adduser', [PersonaController::class, 'funAddUserPersona']);

    //CRUD API REST USER
    Route::get('/user', [UserController::class, 'funListar']);
    Route::post('/user', [UserController::class, 'funGuardar']);
    Route::get('/user/{id}', [UserController::class, 'funMostrar']);
    Route::put('user/{id}', [UserController::class, 'funModificar']);
    Route::delete('/user/{id}', [UserController::class, 'funEliminar']);

    //CRUD Roles
    Route::apiResource("role", RoleController::class);
    Route::apiResource("persona", PersonaController::class);
    Route::apiResource("permiso", PermisoController::class);
    Route::apiResource("documento", DocumentoController::class);
});

//Auth

Route::prefix('/v1/auth')->group(function () {

    Route::post('/login', [AuthController::class, 'funLogin']);
    Route::post('/register', [AuthController::class, 'funRegister']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'funProfile']);
        Route::post('/logout', [AuthController::class, 'funLogout']);
    });
});

//redirecion de no autenticado
Route::get("/no-autorizado", function () {
    return ["mensaje" => "No autorizado"];
})->name("login");
