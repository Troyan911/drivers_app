<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('upload');
})->name('upload');

Route::resource('trips', \App\Http\Controllers\Objects\TripController::class)->only(['index', 'show']);
Route::resource('drivers', \App\Http\Controllers\Objects\DriverController::class)->only(['index', 'show']);

Route::post('/import-csv', \App\Http\Controllers\Actions\ImportController::class)->name('import.csv');
Route::get('/download', \App\Http\Controllers\Actions\ExportController::class)->name('export.csv');
