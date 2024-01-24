<?php

namespace App\Jobs;

use App\Exports\ResultsExport;
use App\Mail\QuotaMet;
use App\Mail\SurveyResultsExport;
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

    protected $schema_id;
    protected $user_email;

    /**
     * Create a new job instance.
     */
    public function __construct(int $schema_id, $user_email)
    {
        $this->schema_id = $schema_id;
        $this->user_email = $user_email;
    }

    /**
     * Execute the job.
     */
    public function handle(Excel $excel): void
    {
        try {
            $survey = Schema::findOrFail($this->schema_id);

            $export = new ResultsExport($this->schema_id);

            $filePath = 'TIFA - ' . now()->format('Y-m-d') . '  ' . $survey->survey_name . ' Results.xlsx';

            $export->queue($filePath, 'public');

            $file = Storage::disk('public')->get($filePath);

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $survey->survey_name . ' Results.xlsx"',
            ];

            response()->download($file, $survey->survey_name . 'Results.xlsx', $headers);

            //$user = Auth::user();

            if ($this->user_email) {
                Mail::to($this->user_email)
                ->send(new SurveyResultsExport($filePath, $survey->survey_name));
            } else {
                Log::warning('No Authenticated User Found.');
                Mail::to($this->user_email)
                ->send(new SurveyResultsExport($filePath, $survey->survey_name));
            }

        } catch (Exception $e) {
            // Mail::to('kipchumba.kenneth@ymail.com')
            //      ->send(new QuotaMet());

            Log::error('Error Exporting ' . $survey->survey_name . ' Survey Results: ' . $e->getMessage());
            session()->flash('error', 'An Error Occured During ' . $survey->survey_name . ' Survey Results Export. Please Try Again After Some Time.');
        }
    }
}