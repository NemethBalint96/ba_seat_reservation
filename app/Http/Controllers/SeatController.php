<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SeatRelease;
use App\Jobs\SendEmail;
use App\Http\Requests\ReservationValidation;
use App\Http\Requests\PaymentValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SeatController extends Controller
{
    public function home(): View
    {
        $seats = Seat::all();

        return view('seats', ['seats' => $seats]);
    }

    public function reserveSeats(ReservationValidation $request): RedirectResponse
    {
        $selectedSeats = $request->validated('seats');
        if (!Seat::reserveSeats($selectedSeats)) {
            return redirect()->route('home')->with('error', 'Foglalt széket próbál lefoglalni.');
        }

        $timeForReservation = now()->addMinutes(2);
        Cache::put('reserved_seats', $selectedSeats, $timeForReservation);
        dispatch(new SeatRelease($selectedSeats))->delay($timeForReservation);

        return redirect()->route('payment-form');
    }

    public function paymentForm(): View
    {
        $seats = Cache::get('reserved_seats');

        return view('payment', ['seats' => $seats]);
    }

    public function payment(PaymentValidation $request): RedirectResponse
    {
        $email = $request->validated('email');
        $seats = Cache::get('reserved_seats');
        $reservedSeats = Seat::sellSeats($seats);

        dispatch(new SendEmail($email, $reservedSeats));

        return redirect()->route('home')->with('success', 'Sikeres vásárlás! Visszaigazoló e-mail elküldve.');
    }
}
