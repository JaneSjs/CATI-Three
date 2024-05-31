<?php

namespace App\Jobs;

use App\Imports\RespondentsImport;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class ImportRespondents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;

    /**
     * Create a new job instance.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::notice('Spreadsheet File: ' . $this->path);

        try {
            $import = new RespondentsImport();

            Excel::import($import, storage_path('app/' . $this->path), null, \Maatwebsite\Excel\Excel::XLSX, function ($reader)
            {
                $reader->chunkSize(100)->ignoreEmpty();
            });

            //Log the number of successfull and failed imported records
            Log::notice("Successfully Imported Respondents: " . $import->getSuccessfulCount());
            Log::warning("Failed Imported Respondents: " . $import->getFailedCount());

            // Delete File after import
            Storage::delete($this->path);

            Log::notice("ImportRespondents Job Completed. Spreadsheet File: " . $this->path);
        } catch (Exception $e) {
            Log::error('ImportRespondents Job Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            // I want to get an sms alert.

            //Log the number of successfull and failed imported records even during exception
            if (isset($import))
            {
                Log::notice("Successfully Imported Respondents: " . $import->getSuccessfulCount());
                Log::warning("Failed Imported Respondents: " . $import->getFailedCount());  
            }
            throw $e;
        }
    }
}
