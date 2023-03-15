<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DateTimeAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Datetime Routes
|--------------------------------------------------------------------------
|
| Add by Ian
| On 15 Mar 2023
|
*/

// Find out the number of days between two DateTime parameters.
Route::get('/numberOfDays', [DateTimeAPIController::class, 'numberOfDays']);

// Find out the number of complete weeks between two DateTime parameters.
Route::get('/numberOfWeeks', [DateTimeAPIController::class, 'numberOfWeeks']);

//  Allow the specification of a timezone for comparison of input parameters from different timezones.
Route::get('/compareTimezones', [DateTimeAPIController::class, 'compareTimezones']);
