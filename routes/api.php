<?php 
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\BookingController;



Route::post('/create-booking', [BookingController::class, 'store']);
Route::post('/fetch-customer', [ClientController::class, 'verifyContactNumber']);
