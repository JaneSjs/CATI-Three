<?php

namespace App\Exports;

use App\Models\Respondent;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class RespondentsExport implements FromQuery
{
    use Exportable;

    protected $project_id;
    protected $schema_id;

    public function __construct(int $project_id = null, int $schema_id = null)
    {
        $this->project_id = $project_id;
        $this->schema_id = $schema_id;
    }

    /**
     * @return \Illuminate\Support\Query
     */
    public function query()
    {
        $query = Respondent::query();

        if ($this->project_id !== null)
        {
            $query->where('project_id', $this->project_id);
        }

        if ($this->schema_id !== null)
        {
            $query->where('schema_id', $this->schema_id);
        }

        return $query;
    }
}
