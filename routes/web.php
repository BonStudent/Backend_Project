<?php

use Illuminate\Support\Facades\Route;
use App\Models\Details;
use App\Models\Accounts;
use App\Models\Remarks;
use App\Models\Recommendation;
use App\Models\MtsrStatus;
use App\Models\Uploads;
use App\Models\Images;

use App\Http\Controllers\DetailsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\RemarksController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\MtsrStatusController;
use App\Http\Controllers\UploadsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\CSAGController; //csag
use App\Http\Controllers\ISAGController; //isag
use App\Http\Controllers\QUARRYController; //quarry
use App\Http\Controllers\MOEPController; //moep
use App\Http\Controllers\MonitoringOSTCController; //ostc
use App\Http\Controllers\MonitoringInventoryController; //inventory
use App\Http\Controllers\MonitoringWPMController; //work program monitoring
use App\Http\Controllers\MonitoringMBController; //minahang bayan monitoring
use App\Http\Controllers\MonitoringInvestigationController; //investigation

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// MODEL DAPAT DIRI
Route::get('/get_details', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $details = Details::all();

    // Example: Return the retrieved records as JSON
    return response()->json($details);
});

Route::get('/get_accounts', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $accounts = Accounts::all();

    // Example: Return the retrieved records as JSON
    return response()->json($accounts);
});

Route::get('/get_remarks', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $accounts = Remarks::all();

    // Example: Return the retrieved records as JSON
    return response()->json($accounts);
});

Route::get('/get_recommendation', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $accounts = Recommendation::all();

    // Example: Return the retrieved records as JSON
    return response()->json($accounts);
});
Route::get('/get_mtsrstatus', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $accounts = MtsrStatus::all();

    // Example: Return the retrieved records as JSON
    return response()->json($accounts);
});
Route::get('/get_files', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $accounts = Uploads::all();

    // Example: Return the retrieved records as JSON
    return response()->json($accounts);
});
Route::get('/get_images', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $accounts = Images::all();

    // Example: Return the retrieved records as JSON
    return response()->json($accounts);
});

//csag
Route::get('/api/csag', [CSAGController::class, 'index']);
Route::post('/api/csag', [CSAGController::class, 'store']);
//isag
Route::get('/api/isag', [ISAGController::class, 'index']);
Route::post('/api/isag', [ISAGController::class, 'store']);
//quarry
Route::get('/api/quarry', [QUARRYController::class, 'index']);
Route::post('/api/quarry', [QUARRYController::class, 'store']);

//moep
Route::get('/api/MOEP', [MOEPController::class, 'index']);
Route::post('/api/MOEP', [MOEPController::class, 'store']);

//MonitoringOSTC
Route::get('/api/MonitoringOSTC', [MonitoringOSTCController::class, 'index']);
Route::post('/api/MonitoringOSTC', [MonitoringOSTCController::class, 'store']);
Route::put('/api/MonitoringOSTC/{no}', [MonitoringOSTCController::class, 'update']);
Route::delete('/api/MonitoringOSTC/{no}', [MonitoringOSTCController::class, 'destroy']);

//MonitoringInventory
Route::get('/api/MonitoringInventory', [MonitoringInventoryController::class, 'index']);
Route::post('/api/MonitoringInventory', [MonitoringInventoryController::class, 'store']);
Route::put('/api/MonitoringInventory/{id}', [MonitoringInventoryController::class, 'update']);
Route::delete('/api/MonitoringInventory/{id}', [MonitoringInventoryController::class, 'destroy']);

//MonitoringWPM
Route::get('/api/MonitoringWPM', [MonitoringWPMController::class, 'index']);
Route::post('/api/MonitoringWPM', [MonitoringWPMController::class, 'store']);
Route::put('/api/MonitoringWPM/{ID}', [MonitoringWPMController::class, 'update']);
Route::delete('/api/MonitoringWPM/{ID}', [MonitoringWPMController::class, 'destroy']);

//MonitoringMB
Route::get('/api/MonitoringMB', [MonitoringMBController::class, 'index']);
Route::post('/api/MonitoringMB', [MonitoringMBController::class, 'store']);
Route::put('/api/MonitoringMB/{ID}', [MonitoringMBController::class, 'update']);
Route::delete('/api/MonitoringMB/{ID}', [MonitoringMBController::class, 'destroy']);

//MonitoringInvestigation
Route::get('/api/MonitoringInvestigation', [MonitoringInvestigationController::class, 'index']);
Route::post('/api/MonitoringInvestigation', [MonitoringInvestigationController::class, 'store']);
Route::put('/api/MonitoringInvestigation/{ID}', [MonitoringInvestigationController::class, 'update']);
Route::delete('/api/MonitoringInvestigation/{ID}', [MonitoringInvestigationController::class, 'destroy']);

//MonitoringAnti-Illegal

//MonitoringDMPF
Route::get('/api/MonitoringDMPF', [MonitoringDMPFController::class, 'index']);
Route::post('/api/MonitoringDMPF', [MonitoringDMPFController::class, 'store']);
Route::put('/api/MonitoringDMPF/{no}', [MonitoringDMPFController::class, 'update']);
Route::delete('/api/MonitoringDMPF/{no}', [MonitoringDMPFController::class, 'destroy']);

//MonitoringPCMRBM
Route::get('/api/MonitoringPCMRBM', [MonitoringPCMRBMController::class, 'index']);
Route::post('/api/MonitoringPCMRBM', [MonitoringPCMRBMController::class, 'store']);
Route::put('/api/MonitoringPCMRBM/{no}', [MonitoringPCMRBMController::class, 'update']);
Route::delete('/api/MonitoringPCMRBM/{no}', [MonitoringPCMRBMController::class, 'destroy']);


Route::post('/add_details', [DetailsController::class, 'create']);
Route::post('/update_details/{id}/', [DetailsController::class, 'update']);
Route::post('/add_accounts', [AccountsController::class, 'create']);
Route::post('/update_accounts/{id}/', [AccountsController::class, 'update']); 
Route::post('/add_remarks', [RemarksController::class, 'create']);
Route::post('/update_remarks/{id_reference}/', [RemarksController::class, 'update']);
Route::post('/add_recommendation', [RecommendationController::class, 'create']);
Route::post('/update_recommendation/{id_reference}/', [RecommendationController::class, 'update']);
Route::post('/add_mtsrstatus', [MtsrStatusController::class, 'create']);
Route::post('/update_mtsrstatus/{id_reference}/', [MtsrStatusController::class, 'update']);
Route::post('/add_uploads', [UploadsController::class, 'create']);
Route::post('/update_uploads/{id_reference}/', [UploadsController::class, 'update']);
Route::post('/add_images', [ImagesController::class, 'store'])->name('images.store');
Route::post('/update_images/{id_reference}/', [ImagesController::class, 'update']);