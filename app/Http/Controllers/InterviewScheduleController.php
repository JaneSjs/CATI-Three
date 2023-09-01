<?php

namespace App\Http\Controllers;

use App\Models\InterviewSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InterviewScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['scheduled_interviews'] = InterviewSchedule::where('user_id', auth()->id())->paginate(10);
        //dd($data);

        return view('schedules.index', $data);
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
    public function store(Request $request)
    {
        $project_id = $request->input('project_id');
        $schema_id = $request->input('schema_id');
        $interview_id = 1;

        $schedule = [
            'user_id' => auth()->user()->id,
            'project_id' => $project_id,
            'schema_id' => $schema_id,
            'interview_datetime' => Carbon::parse($request->input('interview_datetime')),
            'interview_url' => $request->input('interview_url')
        ];

        //dd($schedule);
        $routeParameters = [$project_id, $schema_id, $interview_id];

        InterviewSchedule::create($schedule);

        return to_route('begin_interview', $routeParameters, 201)->with('success', 'Your Interview Has Been Scheduled Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
