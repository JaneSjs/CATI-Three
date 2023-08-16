<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotaMet extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */
    public function __construct(public $metAttributes, public $survey)
    {
        //dd($metAttributes);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Quota Met Alert For ' . $this->survey->survey_name,
            tags: ['quotas'],
            metadata: [
                'survey_id' => $this->survey->id,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $field_values = [];

        foreach ($this->metAttributes as $criteria)
        {
            $field = $criteria['field'];
            $value = $criteria['value'];

            $field_values[] = ['field' => $field, 'value' => $value];
        }
        
        return new Content(
            html: 'emails.quota_met',
            with: [
                'field_values' => $field_values,
            ],
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
