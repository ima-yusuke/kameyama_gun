<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminGunController;
use App\Http\Controllers\AdminCategoryController;

//トップページ表示
Route::get('/', [MainController::class, 'show'])->name('show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //銃
    Route::get('/dashboard/gun-register', [AdminGunController::class, 'Show'])->name('admin.gun.show');
    Route::post('/dashboard/gun-register', [AdminGunController::class, 'Add'])->name('admin.gun.add');

    //カテゴリー
    Route::get('/dashboard/category-register', [AdminCategoryController::class, 'Show'])->name('admin.category.show');
    Route::post('/dashboard/category-register', [AdminCategoryController::class, 'Add'])->name('admin.category.add');

});

require __DIR__.'/auth.php';
