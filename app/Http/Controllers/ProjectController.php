<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        $data['supervisors'] = User::with('roles')
                            ->whereHas('roles', function (Builder $query)
                            {
                                $query->where('name', 'Supervisor');
                            })->get();

        $data['scriptors'] = User::with('roles')
                            ->whereHas('roles', function (Builder $query)
                            {
                                $query->where('name', 'Scripter');
                            })->get();

        $data['qcs'] = User::with('roles')
                            ->whereHas('roles', function (Builder $query)
                            {
                                $query->where('name', 'QC');
                            })->get();

        //dd($data);

        return view('projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create([
            'name' => $request->input('name'),
            'database' => $request->input('database'),
            'start_date' => Carbon::parse($request->date('start_date')),
            'end_date' => Carbon::parse($request->date('end_date')),
        ]);

        //dd($project);

        $manager_id[] = auth()->user()->id;
        //dd($user_id);
        
        if ($project) {
            $project->managers()->sync($manager_id);
            $project->scriptors()->sync($request->scriptors);
            $project->supervisors()->sync($request->supervisors);
            $project->qcs()->sync($request->qcs);

            // Send Email Notification
            redirect('projects.create')->with('success', 'Project Has Been Created Successfully');
        } else {
            // Send Email Notification
            redirect('projects.create')->with('warning', 'Something went wrong. Please try again.');
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
