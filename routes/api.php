<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\FeatureController;
use App\Http\Controllers\V1\TestimonialController;
use App\Http\Controllers\V1\AuthController;

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

Route::group(['prefix' => 'v1', 'namespace' => 
    'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function() {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::get('categories/check-unique/{name}', [CategoryController::class, 'checkUnique']);

        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('features', FeatureController::class);
        Route::get('features/check-unique/{description}', [FeatureController::class, 'checkUnique']);    // Route to check featre uniqueness

        Route::apiResource('testimonials', TestimonialController::class);

        
});

// Authentication routes
Route::get('users', [AuthController::class, 'index']);
Route::put('users/{user}', [AuthController::class, 'update']);
Route::delete('users/{user}', [AuthController::class, 'destroy']);
Route::get('/users/{user}', [AuthController::class, 'show']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

