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
Route::middleware(['auth:users'])->group(function () {
    // 初期ページ
    Route::get('/weight', [WeightController::class, 'index']);
    // 詳細ページ
    Route::get('/weight/detail', [WeightController::class, 'detail']);
    // 編集ページ
    Route::get('/weight/edit', [WeightController::class, 'edit']);
    // 体重入力記録機能
    Route::post('/weight/store', [WeightController::class, 'store']);
    // 体重入力修正機能
    Route::post('/weight/update', [WeightController::class, 'update']);
});

/**
 * 試合体重設定
 */
Route::middleware(['auth:users'])->group(function () {
    // 試合体重設定ページ
    Route::get('/gameWeight', [GameWeightController::class, 'index'])->middleware(['auth:users']);
    // 試合体重設定機能
    Route::post('/gameWeight/store', [GameWeightController::class, 'store'])->middleware(['auth:users']);
});

require __DIR__ . '/auth.php';