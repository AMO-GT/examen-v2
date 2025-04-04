<?php

namespace App\Mail;

use App\Models\Reservering;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReserveringBevestiging extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * De reservering instantie.
     *
     * @var \App\Models\Reservering
     */
    public $reservering;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservering $reservering)
    {
        $this->reservering = $reservering;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bevestiging van uw afspraak bij The Hair Hub',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservering-bevestiging',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 