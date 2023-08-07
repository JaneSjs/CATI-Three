<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Models\Quota;
use App\Models\Respondent;
use App\Models\Schema;

class QuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function show($schema_id)
    {
        $data['survey'] = Schema::find($schema_id);
        $data['quota'] = Quota::where('schema_id', $schema_id)
                                ->get();

        $data['interviewed_respondents'] = Respondent::where('schema_id', $schema_id)->count();
        //dd($data);

        return view('quotas.show', $data);
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
    public function destroy($schema_id)
    {
        //dd($schema_id);
        $criteria = Quota::where('schema_id', $schema_id)->get();

        if ($criteria->count() > 0) {
            foreach ($criteria as $criterion) {
                $criterion->delete();
            }

            return to_route('surveys.show', $schema_id)->with('success', 'Quota criteria removed successfully');
        }

        return redirect()->route('surveys.show', $schema_id)->with('error', 'No quota criteria found');

    }

    public function remove_quota($schema_id)
    {
        //dd($schema_id);
        $criteria = Quota::where('schema_id', $schema_id)->get();

        if ($criteria->count() > 0) {
            foreach ($criteria as $criterion) {
                $criterion->delete();
            }

            return to_route('surveys.show', $schema_id)->with('success', 'Quota criteria removed successfully');
        }

        return redirect()->route('surveys.show', $schema_id)->with('error', 'No quota criteria found');

    }
}
