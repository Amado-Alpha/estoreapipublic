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

// Public GET Routes
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function() {
    // Publicly accessible routes for products, categories, features, and projects
    Route::get('products', [ProductController::class, 'index']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('features', [FeatureController::class, 'index']);
    Route::get('testimonials', [TestimonialController::class, 'index']);
   
});


// Protected Routes, only accessible via sanctum token authentication
Route::group(['prefix' => 'v1', 'namespace' => 
    'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function() {
        Route::apiResource('products', ProductController::class)->except(['index']);
        Route::apiResource('categories', CategoryController::class)->except(['index']);
        Route::get('categories/check-unique/{name}', [CategoryController::class, 'checkUnique']);

        Route::apiResource('projects', ProjectController::class)->except(['index']);
        Route::apiResource('features', FeatureController::class)->except(['index']);
        Route::get('features/check-unique/{description}', [FeatureController::class, 'checkUnique']);    // Route to check featre uniqueness

        Route::apiResource('testimonials', TestimonialController::class)->except(['index']);

});

// Authentication routes
Route::get('users', [AuthController::class, 'index']);
Route::put('users/{user}', [AuthController::class, 'update']);
Route::delete('users/{user}', [AuthController::class, 'destroy']);
Route::get('/users/{user}', [AuthController::class, 'show']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

