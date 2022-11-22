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

// 体重遷移
Route::get('/weight', [WeightController::class, 'index'])->middleware(['auth:users']);
Route::get('/weight/input', [WeightController::class, 'input'])->middleware(['auth:users']);
Route::post('/weight/memoryWeight', [WeightController::class, 'memoryWeight'])->middleware(['auth:users']);

// 試合体重設定
Route::get('/gameWeight', [GameWeightController::class, 'index'])->middleware(['auth:users']);
Route::post('/gameWeight/store', [GameWeightController::class, 'store'])->middleware(['auth:users']);

require __DIR__.'/auth.php';
