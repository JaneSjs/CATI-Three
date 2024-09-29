<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnalyticsRequest;
use App\Http\Requests\UpdateAnalyticsRequest;
use App\Models\Analytics;
use App\Models\Result;
use App\Models\Schema;

class AnalyticsController extends Controller
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
    public function store(StoreAnalyticsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['result'] = Result::where('schema_id', $id)->first();
        $data['survey'] = Schema::where('id', $id)->first();
        //dd($data);

        return view('analytics.show', $data);
        //return view('analytics.old', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Analytics $analytics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnalyticsRequest $request, Analytics $analytics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analytics $analytics)
    {
        //
    }


    public function analytics_new($schema)
    {

        $survey = Schema::findOrFail($schema);

        $results = $survey->results()->get()->pluck('content');
        // dd($results);
        return view('analytics.new', compact('survey', 'results'));
    }
}