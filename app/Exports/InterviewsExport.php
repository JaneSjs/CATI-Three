<?php

namespace App\Exports;

use App\Models\Interview;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InterviewsExport implements FromQuery, WithHeadings
{
    protected $project_id;
    protected $schema_id;

    function __construct(int $project_id = null, int $schema_id = null)
    {
        $this->project_id = $project_id;
        $this->schema_id = $schema_id;
    }

    public function query()
    {
        if (is_null($this->project_id))
        {
            return Interview::query()
                ->select([
                    'id','user_id','project_id','schema_id','respondent_id','respondent_name','ext_no','phone_called','interview_status','qc_name','quality_control','qc_feedback','start_time','end_time','feedback'
                ])
                ->where('schema_id', $this->schema_id)
                ->whereNotNull('interview_status')
                ->orderBy('id');
        }
        else
        {
            return Interview::query()
                ->select([
                    'id','user_id','project_id','schema_id','respondent_id','respondent_name','ext_no','phone_called','interview_status','qc_name','quality_control','qc_feedback','start_time','end_time','feedback'
                ])
                ->where('project_id', $this->project_id)
                ->whereNotNull('interview_status')
                ->orderBy('id');
        }
    }


    function map($interviews): array
    {
        $mappedInterviews = [];

        foreach ($interviews as $interview) {
            // Calculate Interview Duration
            $duration = 'failed to compute';

            $start_time = Carbon::parse($interview->start_time);
            $end_time = Carbon::parse($interview->end_time);

            $duration = $start_time->diff($end_time)->format('%h Hr %i Min %s Sec');

            $mappedInterviews[] = [
                $interview->id,
                $interview->user->first_name ?? 'None',
                $interview->project_id,
                $interview->schema_id,
                $interview->respondent_id,
                $interview->respondent_name,
                $interview->ext_no,
                $interview->phone_called,
                $interview->interview_status,
                $interview->qc_name,
                $interview->quality_control,
                $interview->qc_feedback,
                $interview->start_time,
                $interview->end_time,
                $interview->feedback,
                $duration,
            ];
        }

        return $mappedInterviews;
    }

    public function headings(): array
    {
        if (is_null($this->project_id))
        {
            return [
                [
                    'Survey ID: ' . $this->schema_id,
                ],
                ['Interview ID','Interviewer Name','Respondent ID','Respondent\'s Name','Caller\'s Extension Number','Phone Called','Interview Status','QC Name','Quality Control','Quality Control Feedback','Start Time','End Time','Interviewer Feedback','Interview Duration',]
            ];
        }
        else
        {
            return [
                [
                    'Project ID: ' . $this->project_id,
                ],
                ['Interview ID','Interviewer Name','Respondent ID','Respondent\'s Name','Caller\'s Extension Number','Phone Called','Interview Status','QC Name','Quality Control','Quality Control Feedback','Start Time','End Time','Interviewer Feedback','Interview Duration',]
            ];
        }
    }
}
