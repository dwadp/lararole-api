<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermissionController;

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

Route::middleware('auth:sanctum')->prefix('auth')->name('auth.')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->prefix('users')->name('users.')->group(function() {
    Route::middleware('permission:all-users')
            ->get('/', [UserController::class, 'index'])
            ->name('index');

    Route::middleware('permission:all-roles')
            ->get('/roles', [UserController::class, 'roles'])
            ->name('roles');

    Route::middleware('permission:create-user')
            ->post('/store', [UserController::class, 'store'])
            ->name('store');

    Route::middleware('permission:update-user')
            ->put('/update/{user}', [UserController::class, 'update'])
            ->name('update');

    Route::middleware('permission:update-user roles')
            ->put('/update-roles/{user}', [UserController::class, 'updateRoles'])
            ->name('update-roles');

    Route::middleware('permission:delete-user')
            ->delete('/delete/{user}', [UserController::class, 'destroy'])
            ->name('delete');
});

Route::middleware('auth:sanctum')->prefix('roles')->name('roles.')->group(function() {
    Route::middleware('permission:all-roles')
            ->get('/', [RoleController::class, 'index'])
            ->name('index');

    Route::middleware('permission:update-role')
        ->put('/update/{role}', [RoleController::class, 'update'])
        ->name('update');

    Route::middleware('permission:update-role permissions')
            ->put('/update-permissions/{role}', [RoleController::class, 'updatePermissions'])
            ->name('update-permissions');
});

Route::middleware('auth:sanctum')->prefix('permissions')->name('permissions.')->group(function() {
    Route::middleware('permission:all-permissions')
            ->get('/', [PermissionController::class, 'index'])
            ->name('index');

    Route::middleware('permission:update-permission')
        ->put('/update/{permission}', [PermissionController::class, 'update'])
        ->name('update');
});

Route::middleware('auth:sanctum')->prefix('posts')->name('posts.')->group(function() {
    Route::middleware('permission:create-post')->post('/store', [PostController::class, 'store']);
    Route::middleware('permission:edit-post')->put('/update/{id}', [PostController::class, 'update']);
    Route::middleware('permission:delete-post')->delete('/delete/{id}', [PostController::class, 'delete']);
});
