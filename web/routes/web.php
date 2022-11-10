<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentTestController;
use App\Http\Controllers\LifeCycleController;
use App\Http\Controllers\WeightController;

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

/**
 * 初期ページ
 */
Route::get('/weight/index', [WeightController::class, 'index'])->middleware(['auth:users']);

/**
 * 表示ページ
 */
Route::get('/weight/show', [WeightController::class, 'show'])->middleware(['auth:users']);

/**
 * 編集ページ
 */
Route::get('/weight/edit', [WeightController::class, 'edit'])->middleware(['auth:users']);

/**
 * 入力ページ
 */
Route::get('/weight/input', [WeightController::class, 'input'])->middleware(['auth:users']);

/**
 * 体重登録
 */
Route::post('/weight/memoryWeight', [WeightController::class, 'memoryWeight'])->middleware(['auth:users']);


/**
 * 削除ページ
 */
Route::get('/weight/delete', [WeightController::class, 'delete'])->middleware(['auth:users']);

require __DIR__.'/auth.php';