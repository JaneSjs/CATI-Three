<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Schema;
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
        $user = User::find(auth()->user()->id);

        $data['projects'] = $user->projects()->paginate(10);

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

            // Send Email Notification
           return redirect(route('projects.index'))->with('success', 'Project Has Been Created Successfully');
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
        //$data['surveys'] = Schema::all();

        //dd($data['users']);
        $data['surveys'] = $project->surveys;

        return view('projects.show', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function creator(Project $project)
    {
        $data['project'] = $project;

        return view('surveys.creator', $data);
    }

    /**
     * Show the form for creating a new resource (open in a new tab).
     */
    public function creator_in_a_new_tab(Project $project)
    {
        $data['project'] = $project;
        //dd($data);

        return view('surveys.creator_in_a_new_tab', $data);
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
