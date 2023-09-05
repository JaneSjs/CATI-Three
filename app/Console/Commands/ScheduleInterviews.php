<?php

namespace App\Console\Commands;

use App\Jobs\ScheduleInterview;
use App\Models\InterviewSchedule;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleInterviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schedule-interviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Interviews';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Fetch scheduled interviews from the database
        $schedules = InterviewSchedule::all();

        foreach ($schedules as $schedule)
        {
            $this->scheduleInterview($schedule);
        }
    }

    private function scheduleInterview($schedule)
    {
        $dateTime = $schedule->interview_datetime;

        Schedule::job(new ScheduleInterview($schedule))->at($dateTime);
    }
}
