<?php

namespace App\Http\Controllers;

use App\Exports\ResultsExport;
use App\Exports\ResultsjsonExport;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Models\Result;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['results'] = Result::paginate();
        //dd($data);

        return view('results.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['result'] = Result::where('schema_id', $id)->first();

        return view('results.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $Result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultRequest $request, Result $Result)
    {
        dd('Here');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $Result)
    {
        //
    }


    /**
     * xlsx Survey Results Export
     */
    public function xlsx_export(int $schema_id)
    {
        return Excel::download(new ResultsjsonExport($schema_id), 'only_survey_results.xlsx', ExcelExcel::XLSX);
    }

    /**
     * csv Survey Results Export
     */
    public function csv_export(int $schema_id)
    {
        return Excel::download(new ResultsjsonExport($schema_id), 'only_survey_results.csv', ExcelExcel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * PDF Results Export
     */
    public function pdf_export(int $id)
    {
        return Excel::download(new ResultsExport($id), 'survey_results.pdf', ExcelExcel::DOMPDF);
    }
}
