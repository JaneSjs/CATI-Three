<?php

namespace App\Jobs;

use App\Imports\RespondentsImport;
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
        $import = new RespondentsImport();

        Excel::import($import, storage_path('app/' . $this->path), null, \Maatwebsite\Excel\Excel::XLSX, function ($reader)
        {
            $reader->ignoreEmpty();
        });

        //Log the number of successfully imported records
        Log::info($import->getSuccessfulCount());

        // Delete File after import
        Storage::delete($this->path);
    }
}
