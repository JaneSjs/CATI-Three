<?php

namespace App\Exports;

use App\Models\Interview;
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
                ->where('schema_id', $this->schemaId)
                ->orderBy('id');
    }

    function map($interviews)
    {
        foreach ($interviews as $interview) {
            return [
                $interview->id,
                $interview->user_id,
                $interview->project_id,
                $interview->schema_id,
                $interview->respondent_id,
                $interview->respondent_name,
                $interview->ext_no,
                $interview->phone_called,
                $interview->audio_recording,
                $interview->qc_id,
                $interview->qc_name,
                $interview->interview_status,
                $interview->survey_url,
                $interview->survey_version,
                $interview->quality_control,
                $interview->start_time,
                $interview->end_time,
                $interview->feedback,
            ];
        }
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
            'Audio Recording',
            'QC Id',
            'QC Name',
            'Interview Status',
            'Survey Url',
            'Survey Version',
            'Quality Control',
            'Start Time',
            'End Time',
            'Feedback'
        ];
    }
}
