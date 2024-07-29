<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\Dashboard;
use App\Models\Interview;
use App\Models\Project;
use App\Models\Role;
use App\Models\Schema;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = new User();

        $data['roles'] = Role::all();
        $data['users'] = User::all();
        $data['projects'] = Project::all();
        $data['surveys'] = Schema::all();

        if (Gate::allows('admin') || auth()->user()->id == 1)
        {
            $data['interviews'] = Interview::orderBy('id', 'DESC')->paginate(10);
            //dd('Admin');
        }
        
        $data['interviews'] = $user->interviews()
                                    ->where('interview_status', '!=', null)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);

        $data['total_interviews'] = Interview::
                                    //->where('project_id', )
                                    where('interview_status', '!=', null)
                                    ->get();

        $data['todays_interviews'] = Interview::where('interview_status', '!=', null)
                                    ->whereDate('start_time', '=', date('Y-m-d'))
                                    ->get();

        $data['user_interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', '!=', 'Cancelled')
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);

        $data['qcd_interviews'] =   Interview::where('qc_id', $user_id)
                                    ->where('interview_status', '!=', null)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);

        $data['total_user_interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('interview_status', 'Interview Completed')
                                    ->where(function ($query)
                                    {
                                        $query->where('quality_control', 'Approved')
                                        ->orWhereNull('quality_control');
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->get();

        $data['total_user_cancelled_interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('quality_control', 'Cancelled')
                                    ->get();

        $data['todays_user_interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('interview_status', '!=', null)
                                    ->whereDate('start_time', '=', date('Y-m-d'))
                                    ->get();                                 
        //dd($data['total_interviews']);
        
        $supervisor = 'Supervisor';
        $interviewer = 'Interviewer';

        $data['supervisors'] = User::whereHas('roles', function ($query) use ($supervisor)
        {
            $query->where('name', $supervisor);
        })->get();

        $data['interviewers'] = User::whereHas('roles', function ($query) use ($interviewer)
        {
            $query->where('name', $interviewer);
        })->get();

        //dd($data['supervisors']);


        return view('dashboard.index', $data);
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
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }

    /**
     * Project Dashboard (Interviewer)
     */
    public function interviews_dashboard($project_id)
    {
        $today = Carbon::today('Africa/Nairobi');
        $user = User::find(auth()->user()->id);

        $data['project'] = Project::find($project_id);

        $data['user_interviews'] = $user->interviews()
                                    ->where('project_id', $project_id)
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', '!=', 'Cancelled')
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);

        $data['todays_user_interviews'] = $user->interviews()
                                    ->where('project_id', $project_id)
                                    ->whereDate('created_at', $today)
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', '!=', 'Cancelled')
                                    ->orderBy('id', 'DESC')
                                    ->get();

        //dd($data['todays_user_interviews']);
        //dd(today());

        $data['total_user_interviews'] = $user->interviews()
                                    ->where('project_id', $project_id)
                                    ->where('interview_status', 'Interview Completed')
                                    ->where(function ($query)
                                    {
                                        $query->where('quality_control', 'Approved')
                                        ->orWhereNull('quality_control');
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->get();

        return view('dashboard.interviews_dashboard', $data);
    }
}
