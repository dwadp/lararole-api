<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('auth')->name('auth.')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->prefix('posts')->name('posts.')->group(function() {
    Route::middleware('permission:create-post')->post('/store', [PostController::class, 'store']);
    Route::middleware('permission:edit-post')->put('/update/{id}', [PostController::class, 'update']);
    Route::middleware('permission:delete-post')->delete('/delete/{id}', [PostController::class, 'delete']);
});
