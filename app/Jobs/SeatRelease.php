<?php

namespace App\Jobs;

use App\Models\Seat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SeatRelease implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $seatIds;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->seatIds = $seatIds;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $seat = Seat::find(1);

        if ($seat && $seat->status === 'foglalt') {
            // Set the seat status to 'szabad' (available)
            $seat->status = 'szabad';
            $seat->save();
            
        }
        // foreach ($this->seatIds as $seatId) {
        //     $seat = Seat::find($seatId);

        //     if ($seat && $seat->status === 'foglalt') {
        //         // Set the seat status to 'szabad' (available)
        //         $seat->status = 'elkelt';
        //         $seat->save();  
        //     }
        // }
    }
}
