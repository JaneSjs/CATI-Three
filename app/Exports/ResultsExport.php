<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ResultsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting
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
            ->select('results.*', 'interviews.respondent_name', 'interviews.phone_called', 'interviews.status', 'users.first_name', 'users.last_name')
            ->where('results.schema_id', $this->schema_id);
    }

    public function map($result): array
    {
        $content = json_decode($result->content, true);

        $values = array_values($content);

        $rowData = [
            $result->first_name . ' ' . $result->last_name,
            $result->respondent_name,
            $result->status,
            $result->schema_id,
            $result->interview_id,
            Date::dateTimeFromTimestamp($result->created_at),
        ];

        $rowData = array_merge($rowData, $values);

        return $rowData;
    }

    public function headings(): array
    {
        $firstRow = Result::where('schema_id', $this->schema_id)->first();

        if ($firstRow) {
            $content = json_decode($firstRow->content, true);

            $fixedHeadings = [
                'Agent',
                'Respondent',
                'Interview Status',
                'Survey Id',
                'Interview Id',
                'Date and Time Results Was Submitted',
            ];   

            $allHeadings = array_merge($fixedHeadings, array_keys($content));

            return $allHeadings;
        }

         // If no data is available, return default headings
        return [
            'Agent',
            'Respondent',
            'Interview Status',
            'Survey Id',
            'Interview Id',
            'Date and Time Results Was Submitted',
            'Survey Questions',
        ];

    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
