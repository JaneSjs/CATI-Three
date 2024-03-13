<?php

namespace App\Jobs;

use App\Exports\ResultsExport;
use App\Mail\QuotaMet;
use App\Mail\SurveyResultsExport;
use App\Models\ExportedFile;
use App\Models\Schema;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class ExportSurveyResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $schemaId;
    protected $fileName;
    protected $surveyName;

    /**
     * Create a new job instance.
     */
    public function __construct(int $userId, int $schemaId, $fileName, $surveyName)
    {
        $this->userId = $userId;
        $this->schemaId = $schemaId;
        $this->fileName = $fileName;
        $this->surveyName = $surveyName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $survey = Schema::findOrFail($this->schemaId);

        try {
            $export = new ResultsExport($this->schemaId);

            $export->queue($this->fileName, 'public/exports');

            $exportedFile = new ExportedFile();

            $exportedFile->user_id = $this->userId;
            //$exportedFile->project_id = $this->project_id;
            $exportedFile->schema_id = $this->schemaId;
            $exportedFile->file_name = $this->fileName;
            $exportedFile->file_size = '';
            $exportedFile->file_type = '';
            $exportedFile->file_path = '';

            $exportedFile->save();


        } catch (Exception $e) {
            // Mail::to('kipchumba.kenneth@ymail.com')
            //      ->send(new QuotaMet());

            Log::error('Error Exporting ' . $this->surveyName . ' Survey Results: ' . $e->getMessage());
            session()->flash('error', 'An Error Occured During ' . $this->surveyName . ' Survey Results Export. Please Try Again After Some Time.');
        }
    }
}