<?php

namespace App\Exports;

use App\Models\Interview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InterviewsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Interview::all();
    }

    public function headings(): array
    {
        return [
            'Interview ID',
            '(Agent) Interviewer ID',
            'Project ID',
            'Survey ID',
            'Respondent ID',
            'Respondent\'s Name',
            'Caller\'s Extension Number',
            'Phone Called',
            'Audio Recording',
            'QC Id',
            'Interview Status',
            'Survey Url',
            'Quality Control',
            'Start Time',
            'End Time',
            'Feedback'
        ];
    }
}
