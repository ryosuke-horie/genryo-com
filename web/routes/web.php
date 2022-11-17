<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentTestController;
use App\Http\Controllers\LifeCycleController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\GameWeightController;

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
 * 入力ページ
 */
Route::get('/weight/input', [WeightController::class, 'input'])->middleware(['auth:users']);

/**
 * 体重登録
 */
Route::post('/weight/memoryWeight', [WeightController::class, 'memoryWeight'])->middleware(['auth:users']);

// 試合体重設定
Route::get('/gameWeight', [GameWeightController::class, 'index'])->middleware(['auth:users']);

// 試合体重設定登録
Route::post('/gameWeight/store', [GameWeightController::class, 'store'])->middleware(['auth:users']);

require __DIR__.'/auth.php';