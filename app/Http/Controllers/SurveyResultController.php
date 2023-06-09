<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyResultRequest;
use App\Http\Requests\UpdateSurveyResultRequest;
use App\Models\SurveyResult;

class SurveyResultController extends Controller
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
    public function store(StoreSurveyResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveyResult $surveyResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveyResult $surveyResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveyResultRequest $request, SurveyResult $surveyResult)
    {
        dd('Here');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyResult $surveyResult)
    {
        //
    }
}
