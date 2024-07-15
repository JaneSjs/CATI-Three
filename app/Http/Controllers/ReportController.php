<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Interview;
use App\Models\Project;
use App\Models\Quota;
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
    public function interviewers($project_id)
    {
        $data['project'] = $project = Project::find($project_id);

        $data['total_interviews'] = $total_interviews = Interview::where('project_id', $project_id)->get();
        $data['quota'] = $quota =  Quota::where('project_id', $project_id)->first();

        if ($quota) {
            $sample_size = $quota->sample_size;
        } else {
            $sample_size = 0;
            session()->flash('danger', "Quota's have have not been set for this project");
        }

        $data['sample_size'] = $sample_size;

        //  Calculate the progress
        if ($quota && $sample_size > 0) {
            $data['progress'] = (count($total_interviews) / $sample_size) * 100;
        } else {
            $data['progress'] = 0;
        }

        $data['interviewers'] = $project->users()->orderBy('first_name')
                                    ->with(['interviews' => function ($query) use ($project_id)
                                    {
                                        $query->where('project_id', $project_id)
                                              ->select('user_id', 
                                                DB::raw('sum(case when quality_control = "Approved" then 1 else 0 end) as total_approved_interviews'),
                                                DB::raw('sum(case when quality_control = "Cancelled" then 1 else 0 end) as total_cancelled_interviews'),
                                                DB::raw('sum(case when quality_control != "Cancelled" then 1 else 0 end) as total_interviews')
                                                    )
                                               ->groupBy('user_id');
                                    }])
                                    ->paginate(20);

        $data['total_interviewers'] = $project->users()->orderBy('first_name')->count();
        //dd($data['total_interviewers']);

        return view('reports.interviewers', $data);
    }

}
