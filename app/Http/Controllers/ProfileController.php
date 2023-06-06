<?php

namespace App\Http\Controllers;

use App\Models\SurveySchema;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = new User();
        $survey = new SurveySchema();

        $data['user']  = $user->find($id);
        $data['roles'] = $user->roles()->get();
        $data['projects'] = $user->projects()->get();
        $data['surveys'] = $survey->users()->get();
        //dd($data['projects']);
        $data['results'] = $user->survey_results();

        return view('profiles.show', $data);
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
