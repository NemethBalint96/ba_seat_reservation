<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Seats reserved successfully.');
    }
}
