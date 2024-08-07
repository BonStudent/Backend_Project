<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSAGController;
use App\Http\Controllers\ISAGController;
use App\Http\Controllers\QUARRYController;
use App\Http\Controllers\MOEPController;
use App\Http\Controllers\monitoringOSTCController;

Route::apiResource('csag', CSAGController::class);
Route::apiResource('isag', ISAGController::class);
Route::apiResource('quarry', QUARRYController::class);
Route::apiResource('MOEP', MOEPController::class);
Route::apiResource('monitoringOSTC', monitoringOSTCController::class); //MTSS Ore Sample Transport Certificate (OSTC)
Route::apiResource('monitoringInventory', monitoringInventoryController::class); //MTSS Inventory
Route::apiResource('monitoringWPM', monitoringWPMController::class); //MTSS Work Program Monitoring
Route::apiResource('monitoringMB', monitoringMBController::class); //MTSS Minahang Bayan Monitoring
Route::apiResource('monitoringInvestigation', monitoringInvestigationController::class); //MTSS Investigation

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});