<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ResultsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, ShouldQueue
{
    use Exportable;
    private $schema_id;
    
    public function __construct(int $schema_id)
    {
        $this->schema_id = $schema_id;
    }

    public function query()
    {
        return Result::query()
            ->join('interviews', 'results.interview_id', '=', 'interviews.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('results.*', 'interviews.*', 'users.first_name', 'users.last_name')
            ->where('results.schema_id', $this->schema_id);
    }

    public function map($result): array
    {
        $content = json_decode($result->content, true);

        $rowData = [
            $result->first_name . ' ' . $result->last_name,
            $result->respondent_name,
            $result->respondent_id,
            $result->phone_called,
            $result->ext_no,
            $result->interview_completed,
            $result->status,
            $result->schema_id,
            $result->interview_id,
            $result->start_time ? Date::dateTimeFromTimestamp($result->start_time) : null,
            $result->end_time ? Date::dateTimeFromTimestamp($result->end_time) : null,
            $result->survey_url,
            $result->feedback,
        ];

        return array_merge($rowData, array_values($content));
    }

    public function headings(): array
    {
        $firstRow = Result::where('schema_id', $this->schema_id)->first();

        $defaultHeadings = [
            'Interviewer',
            'Respondent Name',
            'Respondent Id',
            'Phone Called',
            'Callers Extension',
            'Interview Completed',
            'Interview Status',
            'Survey Id',
            'Interview Id',
            'Start Time',
            'End Time',
            'Survey Url',
            'Feedback'
        ];

        if ($firstRow) {
            $content = json_decode($firstRow->content, true); 

            $allHeadings = array_merge($defaultHeadings, array_keys($content));

            return $allHeadings;
        }

        return $defaultHeadings;

    }

    public function columnFormats(): array
    {
        return [
            13 => NumberFormat::FORMAT_DATE_DATETIME,
            14 => NumberFormat::FORMAT_DATE_DATETIME,
            17 => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function queue(?string $filePath = null, ?string $disk = null, ?string $writerType = null, $diskOptions = [])
    {
        return $this->store($filePath, $disk);
        
    }
}
