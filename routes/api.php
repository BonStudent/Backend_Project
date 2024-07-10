<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartDataController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('chart-data')->group(function () {
    Route::post('update', [ChartDataController::class, 'update']);
    Route::get('fetch/{year}', [ChartDataController::class, 'fetch']);
    Route::get('fetch-latest', [ChartDataController::class, 'fetchLatest']);
});