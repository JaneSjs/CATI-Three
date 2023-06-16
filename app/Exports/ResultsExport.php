<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class ResultsExport implements FromQuery
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
}
