<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ResultsExport implements FromQuery, WithMapping, WithHeadings, ShouldQueue
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

        // Extract the values from the content
        $values = array_values($content);

        // Fill in empty values with an empty string
        $values = array_map(function ($value) {
            return $value ?? '';
        }, $values);

        return $values;
    }

    public function headings(): array
    {
        $content = json_decode(Result::where('schema_id', $this->schema_id)->first()->content, true);

        // Extract the keys from the content for column headings
        $headings = array_keys($content);

        return $headings;
    }
}
