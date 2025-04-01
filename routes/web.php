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

    //銃登録view表示
    Route::get('/dashboard/gun-register', [AdminGunController::class, 'Show'])->name('admin.gun.show');
    //銃登録
    Route::post('/dashboard/gun-register', [AdminGunController::class, 'Add'])->name('admin.gun.add');
    //銃編集view表示
    Route::get('/dashboard/gun-edit', [AdminGunController::class, 'ShowEdit'])->name('admin.gun.edit');
    //銃編集
    Route::post('/dashboard/gun-edit', [AdminGunController::class, 'Update'])->name('admin.gun.update');
    //銃削除
    Route::get('/dashboard/gun-delete{id}', [AdminGunController::class, 'Delete'])->name('admin.gun.delete');

    //カテゴリー登録view表示
    Route::get('/dashboard/category-register', [AdminCategoryController::class, 'Show'])->name('admin.category.show');
    //カテゴリー登録
    Route::post('/dashboard/category-register', [AdminCategoryController::class, 'Add'])->name('admin.category.add');
    //カテゴリー編集view表示
    Route::get('/dashboard/category-edit', [AdminCategoryController::class, 'ShowEdit'])->name('admin.category.edit');
    //カテゴリー編集
    Route::post('/dashboard/category-edit', [AdminCategoryController::class, 'Update'])->name('admin.category.update');
    //カテゴリー削除
    Route::get('/dashboard/category-delete{id}', [AdminCategoryController::class, 'Delete'])->name('admin.category.delete');


});

require __DIR__.'/auth.php';
