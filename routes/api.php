<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSAGController;

Route::apiResource('csag', CSAGController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});