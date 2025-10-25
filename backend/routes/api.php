<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/reg', [AuthController::class, 'reg']);
Route::post('/login', [AuthController::class, 'authorisation']);
Route::post('/logout', [AuthController::class, 'logOut'])->middleware('auth:sanctum');