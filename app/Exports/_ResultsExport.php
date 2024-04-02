<?php

namespace App\Exports;

use App\Models\Result;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
//use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ResultsExport implements FromQuery, WithMapping, WithHeadings, /*WithColumnFormatting,*/ ShouldQueue
{
    use Exportable;

    private $schemaId;

    public function __construct(int $schemaId)
    {
        $this->schemaId = $schemaId;
    }

    public function query()
    {
        return Result::query()
            ->join('interviews', 'results.interview_id', '=', 'interviews.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('results.*', 'interviews.*', 'users.first_name', 'users.last_name')
            ->where('results.schema_id', $this->schemaId);
    }

    public function map($result): array
    {
        try {
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
                $result->start_time ? date('d-m-Y H:i:s', strtotime($result->start_time)) : null,
                $result->end_time ?   date('d-m-Y H:i:s', strtotime($result->end_time)) : null,
                $result->survey_url,
                $result->feedback,
                $result->content,
            ];

            $results = json_decode(stripslashes($result->content), true);

            // Check if $results is an array
            if (!is_array($results)) {
                Log::error('Invalid Survey Results Content For Interview ID : ' . $result->id);
                $results = [];
            }

            foreach ($this->headings() as $heading)
            {
                if (array_key_exists($heading, $results)) {
                    // Check if the content is an array and convert it to a string
                    if (is_array($results[$heading])) {
                        $rowData[] = implode(",", $results[$heading]);
                    } else {
                        $rowData[] = $results[$heading];
                    }
                } else {
                    $rowData[] = null;
                }
            }

            return $rowData;
        } catch (Exception $e) {
            Log::error('Survey Results Export. Error Processing Interview ID ' . $result->id . ' ' . $e->getMessage() . ' { ' . $e->getTrace() . ' }');
            return [];
        }
    }

    /**
     * Flatten nested JSON structure
     */
    protected function flattenArray($array, $rowData, $prefix = '')
    {
         foreach ($array as $key => $value) {
             if (is_array($value)) {
                 $this->flattenArray($value, $rowData, $prefix . $key . '_');
             }
             else
             {
                $rowData[] = $value;
             }
         }
    }

    public function headings(): array
    {
        $firstRow = Result::where('schema_id', $this->schemaId)->first();

        $defaultHeadings = [
            'Interviewer',
            'Respondent Name',
            'Respondent Id',
            'Phone Called',
            'Ext No',
            'Interview Completed',
            'Interview Status',
            'Survey Id',
            'Interview Id',
            'Start Time',
            'End Time',
            'Survey Url',
            'Feedback',
            'Survey Results JSON'
        ];

        if ($firstRow) {
            $content = json_decode($firstRow->content, true);

            $dynamicHeadings = [];

            foreach ($content as $key => $value)
            {
                $dynamicHeadings[] = $key;
            }

            // Merge default headings with dynamic headings
            $allHeadings = array_merge($defaultHeadings, $dynamicHeadings);

            return $allHeadings;
        }

        return $defaultHeadings;

    }
}
