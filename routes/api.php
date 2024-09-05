<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSAGController;
use App\Http\Controllers\ISAGController;
use App\Http\Controllers\QUARRYController;
use App\Http\Controllers\MOEPController;
use App\Http\Controllers\MonitoringOSTCController;
use App\Http\Controllers\MonitoringInventoryController;
use App\Http\Controllers\MonitoringWPMController;
use App\Http\Controllers\MonitoringMBController;
use App\Http\Controllers\MonitoringInvestigationController;


Route::apiResource('csag', CSAGController::class);
Route::apiResource('isag', ISAGController::class);
Route::apiResource('quarry', QUARRYController::class);
Route::apiResource('MOEP', MOEPController::class);
Route::apiResource('MonitoringOSTC', MonitoringOSTCController::class); //MTSS Ore Sample Transport Certificate (OSTC)
Route::apiResource('MonitoringInventory', MonitoringInventoryController::class); //MTSS Inventory
Route::apiResource('MonitoringWPM', MonitoringWPMController::class); //MTSS Work Program Monitoring
Route::apiResource('MonitoringMB', MonitoringMBController::class); //MTSS Minahang Bayan Monitoring
Route::apiResource('MonitoringInvestigation', MonitoringInvestigationController::class); //MTSS Investigation
//MTSS Anti-Illegal
Route::apiResource('MonitoringDMPF', MonitoringDMPFController::class); //MTSS DMPF
Route::apiResource('MonitoringPCMRBM', MonitoringPCMRBMController::class); //MTSS PCMRBM

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
