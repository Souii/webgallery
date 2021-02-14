<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')
->middleware(['auth', 'admin'])
->group(
    function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
        Route::get('/category', [CategoryController::class, 'index'])
        ->name('category.index');
        Route::post('/category', [CategoryController::class, 'store'])
        ->name('category.store');
        Route::resource('image', ImageController::class)
        ->except(['show', 'index']);
    }
);

require __DIR__.'/auth.php';
