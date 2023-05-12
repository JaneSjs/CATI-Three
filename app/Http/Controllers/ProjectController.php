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
        $project = new Project();

        $data['projects'] = $project->with('users')
                                ->orderByDesc('id')
                                ->paginate(10);

        return view('projects.index', $data);
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

        $user_id = [];

        $user_id[] = auth()->user()->id;
        $scriptors = $request->input('scriptors', []);
        $supervisors = $request->input('supervisors', []);
        $qcs = $request->input('qcs', []);

        $project_members = array_merge($user_id, $user_id, $scriptors, $supervisors, $qcs);

        //dd($project_members);
        
        if ($project) {
            $project->users()->sync($project_members);

            // foreach ($project_members as $member) {
            //     $project->users()->attach($member, [
            //         'manager_id' => auth()->user()->id,
            //         'scriptor_id' => in_array($member, $scriptors) ? $member : null,
            //         'supervisor_id' => in_array($member, $supervisors)  ? $member : null,
            //         'qc_id' => in_array($member, $qcs) ? $member : null,
            //     ]);
            // }

            // Send Email Notification
           return redirect(route('projects.create'))->with('success', 'Project Has Been Created Successfully');
        } else {
            // Send Email Notification
           return redirect(route('projects.create'))->with('warning', 'Something went wrong. Please try again.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data['project'] = $project;
        $data['users'] = $project->users()->get();

        //dd($data);
        //$data['surveys'] = $project->surveys;

        return view('projects.show', $data);
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
