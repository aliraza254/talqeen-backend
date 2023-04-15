<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Videos\VideosController;
use App\Http\Controllers\Videos\CategoryController;
use App\Http\Controllers\Videos\SubcategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::middleware(['auth:sanctum'])->name('admin.')->prefix('admin')->group(function () {
    Route::resource('dashboard', AdminController::class);
    Route::resource('videos', VideosController::class);
    Route::resource('video/category', CategoryController::class);
    Route::resource('video/subcategory', SubCategoryController::class);
});
