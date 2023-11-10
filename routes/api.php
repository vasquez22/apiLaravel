<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/estudiante/select', [EstudianteController::class, 'selectStudent']);

    Route::post('/estudiante/store', [EstudianteController::class, 'storeStudent']);

    Route::put('/estudiante/update/{id}', [EstudianteController::class, 'updateStudent']);

    Route::get('/estudiante/find/{id}', [EstudianteController::class, 'findStudent']);

    Route::delete('/estudiante/delete/{id}', [EstudianteController::class, 'deleteStudent']);
});


Route::post('/registrar', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
