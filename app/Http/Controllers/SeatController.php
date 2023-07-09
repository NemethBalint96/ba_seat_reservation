<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SeatRelease;

class SeatController extends Controller
{
    public function home()
    {
        // Fetch all seats from the database
        $seats = Seat::all();

        // Pass the seats to the view
        return view('seats', ['seats' => $seats]);
    }

    public function reserveSeats(Request $request)
    {
        // Validate the form data if needed
        $selectedSeats = $request->input('seats');

        // Check if the selected seats are available
        $availableSeats = Seat::whereIn('id', $selectedSeats)
            ->where('status', 'szabad')
            ->get();

        if ($availableSeats->count() !== count($selectedSeats)) {
            return redirect()->back()->with('error', 'Some seats are no longer available.');
        }

        // Perform the seat reservation logic here
        foreach ($selectedSeats as $seatId) {
            $seat = Seat::find($seatId);

            $seat->reserve();
        }

        $expiresAt = now()->addMinutes(2);

        Cache::put('reserved_seats', $selectedSeats, 10);

        $dateTime = \Carbon\Carbon::now();

        SeatRelease::dispatch()->delay($dateTime->addSeconds(5));

        return redirect('payment-form');
    }

    public function paymentForm(Request $request)
    {
        $number = Cache::get('reserved_seats');

        return view('payment', ['msg' => json_encode($number)]);
    }

    public function payment(Request $request)
    {
        $email = $request->input('email');

        $number = Cache::get('reserved_seats');

        return $number;
    }
}
