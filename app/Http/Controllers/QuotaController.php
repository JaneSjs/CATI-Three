<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Models\Quota;

class QuotaController extends Controller
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
    public function store(StoreQuotaRequest $request)
    {
        $quota_criteria = $request->input('quota_criteria');

        foreach ($quota_criteria as $attribute => $criteria) {
            foreach ($criteria as $value => $target_count) {
                //dd($criteria);
                Quota::create([
                    'project_id' => $request->project_id,
                    'schema_id' => $request->schema_id,
                    'attribute' => $attribute,
                    'value' => $value,
                    'target_count' => $target_count,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Quota Criteria for that Survey has been Set Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quota $quota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quota $quota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuotaRequest $request, Quota $quota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quota $quota)
    {
        //
    }
}
