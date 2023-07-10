<?php

use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckOrderCache;

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

Route::get('/', [SeatController::class, 'home'])->name('home');
Route::post('/reserve-seats', [SeatController::class, 'reserveSeats'])->name('reserve-seats');

Route::middleware([CheckOrderCache::class])->group(function () {
    Route::get('/payment-form', [SeatController::class, 'paymentForm'])->name('payment-form');
    Route::post('/payment', [SeatController::class, 'payment'])->name('payment');
});
