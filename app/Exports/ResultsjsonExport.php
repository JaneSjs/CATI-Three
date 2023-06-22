<?php

namespace App\Exports;

//use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ResultsjsonExport implements FromQuery, WithMapping, WithMultipleSheets
{
    use Exportable;

    private $schema_id;

    public function __construct(int $schema_id)
    {
        $this->schema_id = $schema_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Result::query()->where('schema_id', $this->schema_id);
    }

    public function map($row): array
    {
        return [
            $row->content,
        ];
    }

    public function sheets(): array
    {
        $results = Result::where('schema_id', $this->schema_id)->get();

        $sheets = [];

        foreach ($results as $index => $result) {
            $sheets[] = new ResultSheetExport($result);
        }

        return $sheets;
    }
}
