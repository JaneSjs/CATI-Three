<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use App\Models\User;
use App\Reports\MyReport;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = new MyReport();

        $report->run();

        $data['report'] = $report;


        $data['dataSource'] = $report->dataStore("respondents");

        return view('reports.index', $data);
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
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

    /**
     * Interviewers Report Per Project
     */
    public function interviewers($projectId)
    {
        $data['interviewers'] = User::orderBy('first_name')
                                     ->with(['interviews' => function ($query) use ($projectId)
                                     {
                                         $query->where('project_id', $projectId);
                                     }])
                                     ->paginate(20);

        return view('reports.interviewers', $data);
    }

}
