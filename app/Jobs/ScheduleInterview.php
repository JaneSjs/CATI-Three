<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ScheduleInterview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $interviewUrl;

    /**
     * Create a new job instance.
     */
    public function __construct($interviewUrl)
    {
        $this->interviewUrl = $interviewUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get($this->interviewUrl);

        
    }
}
