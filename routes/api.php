<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PublisherController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('publishers')->group(function () {
    Route::get('/', [PublisherController::class, 'index']);
    Route::post('/', [PublisherController::class, 'store']);
    Route::delete('/{publisher}', [PublisherController::class, 'destroy']);
});