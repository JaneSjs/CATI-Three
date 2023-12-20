<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDpiaRequest;
use App\Http\Requests\UpdateDpiaRequest;
use App\Models\Dpia;
use App\Models\Project;

class DpiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreDpiaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($project_id, $schema_id = null)
    {
        $data['project'] = Project::where('id', $project_id)->first();

        $data['project_dpia'] = Dpia::where('project_id', $project_id)->first();

        $data['schema_dpia'] = Dpia::where('schema_id', $schema_id)->first();

        //dd($data);

        return view('dpias.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dpia $dpia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDpiaRequest $request, Dpia $dpia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dpia $dpia)
    {
        //
    }
}
