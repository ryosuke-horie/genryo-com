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

Route::middleware(['auth:users'])->group(function () {
    /**
     * 体重遷移
     */
    Route::prefix('weight')->group(
        function () {
            // 初期ページ
            Route::get('/', [WeightController::class, 'index']);
            // 詳細ページ
            Route::get('/detail', [WeightController::class, 'detail']);
            // 編集ページ
            Route::get('/edit', [WeightController::class, 'edit']);
            // 体重入力記録機能
            Route::post('/store', [WeightController::class, 'store']);
            // 体重入力修正機能
            Route::post('/update', [WeightController::class, 'update']);
        }
    );

    /**
     * 試合体重設定
     */
    Route::prefix('gameWeight')->group(
        function () {
            // 試合体重設定ページ
            Route::get('/', [GameWeightController::class, 'index']);
            // 試合体重設定機能
            Route::post('/store', [GameWeightController::class, 'store']);
        }
    );
});

require __DIR__ . '/auth.php';