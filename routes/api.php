<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSAGController;
use App\Http\Controllers\ISAGController;
use App\Http\Controllers\QUARRYController;
use App\Http\Controllers\MOEPController;

Route::apiResource('csag', CSAGController::class);
Route::apiResource('isag', ISAGController::class);
Route::apiResource('quarry', QUARRYController::class);
Route::apiResource('MOEP', MOEPController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});