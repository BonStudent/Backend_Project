<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSAGController;
use App\Http\Controllers\ISAGController;

Route::apiResource('csag', CSAGController::class);
Route::apiResource('isag', ISAGController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});