<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\GameWeightController;

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

/**
 * 体重遷移
 */
// 初期ページ
Route::get('/weight', [WeightController::class, 'index'])->middleware(['auth:users']);
// 詳細ページ
Route::get('/weight/detail', [WeightController::class, 'detail'])->middleware(['auth:users']);
// 編集ページ
Route::get('/weight/edit', [WeightController::class, 'edit'])->middleware(['auth:users']);
// 体重入力記録機能
Route::post('/weight/memoryWeight', [WeightController::class, 'memoryWeight'])->middleware(['auth:users']);
// 体重入力修正機能
Route::post('/weight/update', [WeightController::class, 'update'])->middleware(['auth:users']);

/**
 * 試合体重設定
 */
// 試合体重設定ページ
Route::get('/gameWeight', [GameWeightController::class, 'index'])->middleware(['auth:users']);
// 試合体重設定機能
Route::post('/gameWeight/store', [GameWeightController::class, 'store'])->middleware(['auth:users']);

require __DIR__.'/auth.php';
