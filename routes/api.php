<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\PublisherController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::delete('/{book}', [BookController::class, 'destroy']);
});

Route::prefix('publishers')->group(function () {
    Route::get('/', [PublisherController::class, 'index']);
    Route::post('/', [PublisherController::class, 'store']);
    Route::delete('/{publisher}', [PublisherController::class, 'destroy']);
});

Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::delete('/{transaction}', [TransactionController::class, 'destroy']);
});