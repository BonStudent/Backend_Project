<?php

use Illuminate\Support\Facades\Route;
use App\Models\Details;

use App\Http\Controllers\DetailsController;

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


Route::get('/get_details', function () {
    // Example: Retrieve all records from the "tabledetails" table
    $details = Details::all();

    // Example: Return the retrieved records as JSON
    return response()->json($details);
});


Route::post('/add_details', [DetailsController::class, 'create']);

Route::post('/update_details/{id}/', [DetailsController::class, 'update']);