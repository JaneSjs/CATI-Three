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
        return Result::query()->where('schema_id', $this->schema_id);
    }

    public function map($result): array
    {
        return [
            $result->schema_id,
            $result->content,
            Date::dateTimeFromTimestamp($result->timestamp),
        ];
    }

    public function headings(): array
    {
        return [
            'Survey Id',
            'Survey Results',
            'Date Results Was Submitted',
        ];   
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
