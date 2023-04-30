<?php

use App\Http\Controllers\Api\v1\AuthorController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\PostController1;
use App\Http\Controllers\Api\v1\UserController;
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
    Route::get('user_by_email/{email}', [UserController::class, 'getUserByEmail'])->name('user_by_email');

    Route::middleware('auth:sanctum')->group(callback: function () {
        Route::get('authors_list', [AuthorController::class, 'list'])->name('authors_list');
        Route::apiResource('posts', PostController::class);
        Route::apiResource('authors', AuthorController::class);
        Route::post('/identity', [AuthController::class, 'identity'])->name('identity');
    });

    /*Route::name('posts.')->prefix('posts')->group(callback: function () {

    });*/
});