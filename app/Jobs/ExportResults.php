<?php

namespace App\Jobs;

use App\Exports\ResultsExport;
use App\Models\Schema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel;

class ExportResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $schema_id;

    /**
     * Create a new job instance.
     */
    public function __construct(int $schema_id)
    {
        $this->schema_id = $schema_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $survey = Schema::where('id', $this->schema_id)->first();

        if (!$survey) {
            session()->flash('warning', 'Survey Not Found');
        }

        $export = new ResultsExport($this->schema_id);

        $fileName = 'TIFA - ' . date('Y-m-d') . $survey->survey_name . ' Results.xlsx';

        Excel::download($export, $fileName, Excel::XLSX);

        Excel::
    }
}