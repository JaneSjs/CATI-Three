<?php

namespace App\Jobs;

use App\Models\Respondent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexRespondents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $respondents;

    /**
     * Create a new job instance.
     * 
     * @param array $respondents
     */
    public function __construct(array $respondents)
    {
        $this->respondents = $respondents;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->respondents as $respondent)
        {
            $respondent->searchable();
        }
    }
}
