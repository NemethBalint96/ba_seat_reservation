<?php

namespace App\Jobs;

use App\Models\Seat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SeatRelease implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $seatIds;

    /**
     * Create a new job instance.
     */
    public function __construct(array $seatIds)
    {
        $this->seatIds = $seatIds;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Seat::releseSeats($this->seatIds);
    }
}
