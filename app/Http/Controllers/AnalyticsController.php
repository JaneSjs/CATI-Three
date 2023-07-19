<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnalyticsRequest;
use App\Http\Requests\UpdateAnalyticsRequest;
use App\Models\Analytics;
use App\Models\Result;

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

        return view('analytics.show', $data);
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
}
