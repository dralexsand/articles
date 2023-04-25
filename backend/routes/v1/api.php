<?php

use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\PostController1;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::name('api.')->group(callback: function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(callback: function () {
        Route::post('/identity', [AuthController::class, 'identity'])->name('identity');
    });

    Route::name('posts.')->prefix('posts')->group(callback: function () {
        Route::apiResource(PostController::class);
    });
});