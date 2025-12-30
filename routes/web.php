<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    
    //users
    Route::resource('users', UserController::class);
    //permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    
    // PERUBAHAN PENTING: Ubah GET menjadi PUT untuk update
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    
    // PERUBAHAN: Gunakan DELETE method untuk destroy
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    //roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    //articles
    // Article Routes
Route::resource('articles', ArticleController::class);

// Additional article routes
Route::get('/articles/status/{status}', [ArticleController::class, 'byStatus'])->name('articles.byStatus');
Route::get('/articles/category/{category}', [ArticleController::class, 'byCategory'])->name('articles.byCategory');
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');


});

require __DIR__.'/auth.php';
