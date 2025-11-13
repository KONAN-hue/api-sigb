<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;

// Authentification
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Routes Utilisateur (protégées par auth:api)
Route::middleware('auth:api')->group(function () {
    Route::get('/utilisateurs', [UtilisateurController::class, 'index']);
    Route::post('/utilisateurs', [UtilisateurController::class, 'store']);
    Route::get('/utilisateurs/{utilisateur}', [UtilisateurController::class, 'show']);
    Route::put('/utilisateurs/{utilisateur}', [UtilisateurController::class, 'update']);
    Route::delete('/utilisateurs/{utilisateur}', [UtilisateurController::class, 'destroy']);
});

// Inscription libre (role = user)
Route::post('/register', [AuthController::class, 'register']);
