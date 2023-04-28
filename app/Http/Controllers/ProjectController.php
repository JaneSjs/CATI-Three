<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        dd($request->all());
        // Use role ids for supervisors, scriptors and qcs
        $project = [
            'name' => $request->input('name'),
            'supervisors' => $request->collect('supervisors'),
            'scriptors' => [1,2,3],
            'qcs' => [1,2,3],
            'database' => $request->input('database'),
            'start_date' => Carbon::parse($request->date('start_date')),
            'end_date' => Carbon::parse($request->date('end_date')),
        ];

        dd($project);

        
        if (Project::create()) {
            // Send Email Notification
            redirect('projects.create')->with('success', 'Project Has Been Created Successfully');
        } else {
            // code...
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data['surveys'] = $project->surveys;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
