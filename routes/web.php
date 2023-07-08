<?php

use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Seat;

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

Route::get('/testroute', function() {
  $seats = Seat::all();

  // The email sending is done using the to method on the Mail facade
  Mail::to('n.b.boss@hotmail.com')->send(new ConfirmationEmail($seats));
});