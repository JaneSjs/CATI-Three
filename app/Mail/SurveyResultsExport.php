<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SurveyResultsExport extends Mailable
{
    use Queueable, SerializesModels;

    public $fileName;
    public $schemaId;
    public $surveyName;

    /**
     * Create a new message instance.
     */
    public function __construct($fileName, $schemaId, $surveyName)
    {
        $this->fileName = $fileName;
        $this->schemaId = $schemaId;
        $this->surveyName = $surveyName;


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->surveyName . ' Results Export',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.survey_results_export',
            with: [
                'downloadLink' => route('exported_files', $this->schemaId)
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            //Attachment::fromStorage($this->fileName),
        ];
    }
}
