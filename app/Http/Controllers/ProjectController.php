<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\Schema;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('admin') || auth()->user()->id == 1)
        {
            $data['projects'] = Project::orderBy('id', 'DESC')->paginate(10);
            //dd('Admin');
        } elseif (Gate::allows('ceo'))
        {
            $data['projects'] = Project::orderBy('id', 'DESC')->paginate(10);
            //dd('Head');
        }
        elseif (Gate::allows('head'))
        {
            $data['projects'] = Project::with('users')->orderBy('id', 'DESC')->paginate(10);
            //dd('Head');
        }
        elseif (Gate::allows('manager'))
        {
            $data['projects'] = Project::orderBy('id', 'DESC')->paginate(10);
            //dd('Manager');
        }
        else
        {
            //dd('Here');
            $user = User::find(auth()->user()->id);

            $data['projects'] = $user->projects()->orderBy('id', 'DESC')->paginate(10);
        }       

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

        $data['coordinators'] = User::with('roles')
                            ->whereHas('roles', function (Builder $query)
                            {
                                $query->where('name', 'Coordinator');
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
            //'dpia' => $request->input('dpia'),
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

            // Send Relevant members an email alert so they can prepare for the project.
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
        $data['users'] = User::whereHas('roles', function ($query)
        {
            $query->whereIn('name', ['Interviewer','Client', 'QC']);
        })->get();
        //dd($data['users']);

        $data['project'] = $project;
        $data['members'] = $project->users()->get();
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
        $data['project'] = $project;

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

        return view('projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($project);
        if ($project)
        {
            
            $project->update([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'database' => $request->input('database'),
                'start_date' => Carbon::parse($request->date('start_date')),
                'end_date' => Carbon::parse($request->date('end_date')),
            ]);

            $project->users()->sync($request->users);

            return redirect()->back()->with('success', 'Project Updated Successfully.');
        } else {
            return redirect()->back()->with('error', 'Project not found.');
        }
        
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project) {
            $project->delete();
            return redirect()->back()->with('success', 'Project Deleted Successfully.');
        }

        return redirect()->back()->with('error', 'Project wasn\'t found, thus wasn\'t deleted');
    }
}
