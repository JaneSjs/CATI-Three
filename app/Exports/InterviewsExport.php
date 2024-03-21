<?php

namespace App\Exports;

use App\Models\Interview;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InterviewsExport implements FromQuery, WithHeadings
{
    protected $schemaId;

    function __construct(int $schemaId)
    {
        $this->schemaId = $schemaId;
    }

    public function query()
    {
        return Interview::query()
                ->select([
                    'id','user_id','project_id','schema_id','respondent_id','respondent_name','ext_no','phone_called','interview_status','qc_name','quality_control','qc_feedback','start_time','end_time','feedback'
                ])
                ->where('schema_id', $this->schemaId)
                ->whereNotNull('interview_status')
                ->orderBy('id');
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
                $interview->user_id,
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
                $duration,
                $interview->feedback,
            ];
        }

        return $mappedInterviews;
    }

    public function headings(): array
    {
        return [
            'Interview ID',
            'Interviewer ID',
            'Project ID',
            'Survey ID',
            'Respondent ID',
            'Respondent\'s Name',
            'Caller\'s Extension Number',
            'Phone Called',
            'Interview Status',
            'QC Name',
            'Quality Control',
            'Quality Control Feedback',
            'Start Time',
            'End Time',
            'Interview Duration',
            'Interviewer Feedback',
        ];
    }
}
