<?php

namespace App\Jobs;

use App\Mail\SurveyResultsExport;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailSurveyResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;
    protected $fileName;
    protected $schemaId;
    protected $surveyName;

    /**
     * Create a new job instance.
     */
    public function __construct(string $userEmail, string $fileName, int $schemaId, string $surveyName)
    {
        $this->userEmail = $userEmail;
        $this->fileName = $fileName;
        $this->schemaId = $schemaId;
        $this->surveyName = $surveyName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->userEmail)
            ->cc('admin@tifaresearch.com')
            ->send(new SurveyResultsExport($this->fileName, $this->schemaId, $this->surveyName));
        } catch (Exception $e) {
            Log::error('Failed to send Survey Results Export: ' . $e->getMessage());
        }
    }
}
