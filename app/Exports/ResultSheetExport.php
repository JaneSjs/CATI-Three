<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;

class ResultSheetExport implements FromView, ShouldAutoSize, Responsable
{
    use Exportable;

    protected $results;

    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    public function view(): View
    {
        return view('results.exports.result', [
            'results' => $this->results,
        ]);
    }

    // public function withResponse($response, $writer, $excel)
    // {
    //     $sheet = $writer->getSheetByIndex(0);
    //     $sheet->setTitle('Survey Result ' . $this->result->id);
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event)
            {
                $event->sheet->setTitle('Survey Results');
            }
        ];
    }
}
