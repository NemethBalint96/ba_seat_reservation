<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail;
use Illuminate\Database\Eloquent\Collection;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $recipient;
    private Collection $data;

    /**
     * Create a new job instance.
     */
    public function __construct(string $recipient, Collection $data)
    {
        $this->recipient = $recipient;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->recipient)->send(new ConfirmationEmail($this->data));
    }
}
