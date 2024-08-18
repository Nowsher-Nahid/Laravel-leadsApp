<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// class LeadPublishedNotification extends Mailable implements ShouldQueue
class LeadPublishedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $lead; // Property to hold the lead data

    /**
     * Create a new message instance.
     *
     * @param $lead
     * @return void
     */
    public function __construct($lead)
    {
        $this->lead = $lead; // Initialize the lead property
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lead Published Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lead_published', // Update with the correct view path
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
