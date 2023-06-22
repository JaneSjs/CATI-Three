<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;

class ResultSheetExport implements FromView, ShouldAutoSize, Responsable
{
    use Exportable;

    protected $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function view(): View
    {
        return view('results.exports.result', [
            'result' => $this->result,
        ]);
    }

    public function withResponse($response, $writer, $excel)
    {
        $sheet = $writer->getSheetByIndex(0);
        $sheet->setTitle('Survey Result ' . $this->result->id);
    }
}
