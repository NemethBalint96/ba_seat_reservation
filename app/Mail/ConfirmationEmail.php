<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class ConfirmationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private Collection $seats;

    /**
     * Create a new message instance.
     *
     * @param  array  $seats
     */
    public function __construct(Collection $seats)
    {
        $this->seats = $seats;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Székfoglalás visszaigazolás')
            ->view('mail.email')
            ->with('seats', $this->seats);
    }
}
