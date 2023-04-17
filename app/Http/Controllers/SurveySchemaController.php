<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveySchemaRequest;
use App\Http\Requests\UpdateSurveySchemaRequest;
use App\Http\Resources\SurveySchemaResource;
use App\Models\SurveySchema;
use Illuminate\Support\Facades\Log;

class SurveySchemaController extends Controller
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
        return view('surveys.create');
    }

    /**
     * Store survey schema into the database
     */
    public function store(StoreSurveySchemaRequest $request)
    {
        $survey_schema = new SurveySchema;

        //$survey_schema->user_id = 1;
        $survey_schema->name = $request->name;
        $survey_schema->content = json_encode($request->content);
        //$survey_schema->updated_by = 'test';
        //$survey_schema->deleted_by = 'test';

        $survey_schema->save();

        return response('Survey Schema Stored Successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveySchema $survey)
    {
        return response($survey, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveySchema $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveySchemaRequest $request, SurveySchema $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveySchema $survey)
    {
        //
    }

}
