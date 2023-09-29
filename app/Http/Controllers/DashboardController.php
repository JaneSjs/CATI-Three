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
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $data['interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('interview_status', '!=', null)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);
        $data['total_interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('interview_status', '!=', null)
                                    ->get();
        $data['todays_interviews'] = User::find(auth()->user()->id)
                                    ->interviews()
                                    ->where('interview_status', '!=', null)
                                    ->where('start_time', '=', date('Y-m-d'))
                                    ->get();                                   
        //dd($data['total_interviews']);
        
        $roleName = 'Supervisor';

        $data['supervisors'] = User::whereHas('roles', function ($query) use ($roleName)
        {
            $query->where('name', $roleName);
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
}
