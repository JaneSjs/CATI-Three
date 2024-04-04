<?php

namespace App\Exports;

use App\Models\Result;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
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
    protected $dynamicHeadings;
    
    public function __construct(int $schema_id)
    {
        $this->schema_id = $schema_id;
        // Initialize dynamic headings
        $this->dynamicHeadings = $this->retrieveDynamicHeadings();
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
        Log::info("Result: ". $result);
        try {
            $content = json_decode(stripslashes($result->content), true);

            // Check if $content is an array
            if (!is_array($content)) {
                Log::error('Invalid JSON Survey Results For Interview ID : ' . $result->id);
                // Set $content to null
                $content = null;
            }

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
                $result->content,
            ];

            // Different Approach. Flatten nested JSON structure
            //$this->flattenArray($content, $rowData);

            Log::info("Dynamic Headings " . $this->dynamicHeadings);
            // Populate the row with values from the JSON data
            foreach ($this->dynamicHeadings as $heading)
            {
                Log::info("Dynamic Heading: " . $heading);
                // Check if the key exists in the JSON data
                if (isset($content[$heading]))
                {
                    Log::info("JSON Value: " . $content[$heading]);
                    // If the value is an array, encode it to json
                    if (is_array($content[$heading])) {
                        $rowData[] = json_encode($content[$heading]);
                    } else {
                        // If the value is a scalar, add it directly
                        $rowData[] = $content[$heading];
                        Log::info($rowData);
                    }
                }
                else
                {
                    $rowData[] = null;
                }
            }
        } catch (Exception $e) {
            Log::error('Survey Results Export. Error Processing result ID: ' . $result->id . ' ' . $e->getMessage() . ' { ' . $e->getTrace() . ' }');

            $rowData = [];
        }

        return $rowData;
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
        $firstRow = Result::where('schema_id', $this->schema_id)->first();

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

    protected function retrieveDynamicHeadings()
    {
        $firstRow = Result::where('schema_id', $this->schema_id)->first();

        $dynamicHeadings = [];

        if ($firstRow) {
            $content = json_decode($firstRow->content, true);

            foreach ($content as $key => $value)
            {
                $dynamicHeadings = $key;    
            }
        }

        return $dynamicHeadings;
    }

    public function columnFormats(): array
    {
        return [
            10 => NumberFormat::FORMAT_DATE_DATETIME,
            11 => NumberFormat::FORMAT_DATE_DATETIME,
            17 => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function queue(?string $filePath = null, ?string $disk = null)
    {
        return $this->store($filePath, $disk);
        
    }

    private function handleMultipleChoiceQuestions(array $rowData, array $choices, string $questionKey): array
    {
         foreach ($choices as $index => $choice)
         {
             $rowData[] = $choice;
         }

         return $rowData;
    }
}
