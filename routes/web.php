<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\KategorisController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/dashboard/kategoris', [KategorisController::class, 'index'])->name('admin.kategoris.index');
    Route::get('/admin/dashboard/kategoris/create', [KategorisController::class, 'create'])->name('admin.kategoris.create');
    Route::post('/admin/dashboard/kategoris', [KategorisController::class, 'store'])->name('admin.kategoris.store');
    Route::get('/admin/dashboard/kategoris/{id}/edit', [KategorisController::class, 'edit'])->name('admin.kategoris.edit');
    Route::put('/admin/dashboard/kategoris/{id}', [KategorisController::class, 'update'])->name('admin.kategoris.update');
    Route::delete('/admin/dashboard/kategoris/{id}', [KategorisController::class, 'destroy'])->name('admin.kategoris.destroy');

    Route::get('/admin/dashboard/buku', [BukuController::class, 'index'])->name('admin.buku.index');
    Route::get('/admin/dashboard/buku/create', [BukuController::class, 'create'])->name('admin.buku.create');
    Route::post('/admin/dashboard/buku', [BukuController::class, 'store'])->name('admin.buku.store');
    Route::get('/admin/dashboard/buku/{id_buku}/edit', [BukuController::class, 'edit'])->name('admin.buku.edit');
    Route::put('/admin/dashboard/buku/{id_buku}', [BukuController::class, 'update'])->name('admin.buku.update');
    Route::delete('/admin/dashboard/buku/{id_buku}', [BukuController::class, 'destroy'])->name('admin.buku.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/user/favorites', [UserController::class, 'showFavorites'])->name('user.favorites');
    Route::post('/user/remove-favorite', [UserController::class, 'removeFavorite'])->name('user.remove.favorite');
    Route::post('/user/add-favorite', [UserController::class, 'addFavorite'])->name('user.add.favorite');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
