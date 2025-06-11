<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\AdminGunController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminBulletController;
use App\Http\Controllers\AdminOtherController;

//トップページ表示
Route::get('/', [MainController::class, 'show'])->name('show');

//商品一覧ページ表示
Route::get('/product-list', [ProductListController::class, 'Show'])->name('product-list.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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

    //弾登録view表示
    Route::get('/dashboard/bullet-register', [AdminBulletController::class, 'Show'])->name('admin.bullet.show');
    //弾登録
    Route::post('/dashboard/bullet-register', [AdminBulletController::class, 'Add'])->name('admin.bullet.add');
    //弾編集view表示
    Route::get('/dashboard/bullet-edit', [AdminBulletController::class, 'ShowEdit'])->name('admin.bullet.edit');
    //弾編集
    Route::post('/dashboard/bullet-edit', [AdminBulletController::class, 'Update'])->name('admin.bullet.update');
    //弾削除
    Route::get('/dashboard/bullet-delete{id}', [AdminBulletController::class, 'Delete'])->name('admin.bullet.delete');

    //その他登録view表示
    Route::get('/dashboard/other-register', [AdminOtherController::class, 'Show'])->name('admin.other.show');
    //その他登録
    Route::post('/dashboard/other-register', [AdminOtherController::class, 'Add'])->name('admin.other.add');
    //その他編集view表示
    Route::get('/dashboard/other-edit', [AdminOtherController::class, 'ShowEdit'])->name('admin.other.edit');
    //その他編集
    Route::post('/dashboard/other-edit', [AdminOtherController::class, 'Update'])->name('admin.other.update');
    //その他削除
    Route::get('/dashboard/other-delete{id}', [AdminOtherController::class, 'Delete'])->name('admin.other.delete');

});

require __DIR__.'/auth.php';
