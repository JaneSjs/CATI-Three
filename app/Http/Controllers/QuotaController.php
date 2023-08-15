<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Models\Interview;
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
        Quota::create([
            'project_id' => $request->input('project_id'),
            'schema_id' => $request->input('schema_id'),
            'total_target' => $request->input('total_target'),
            'male_target' => $request->input('male_target'),
            'female_target' => $request->input('female_target'),
        ]);

        return redirect()->back()->with('success', 'Quota Criteria for the Survey has been Set Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($schema_id)
    {
        $data['survey'] = Schema::find($schema_id);
        $data['quota'] = Quota::where('schema_id', $schema_id)
                                ->first();
        $data['interviews'] = Interview::where('schema_id', $schema_id)->get();
        $data['total_interviews'] = Interview::where('schema_id', $schema_id)->count();
        $data['approved_interviews'] = Interview::where('schema_id', $schema_id)->where('status', 'Approved')->count();
        $data['cancelleded_interviews'] = Interview::where('schema_id', $schema_id)->where('status', 'Cancelled')->count();

        $data['interviewed_respondents'] = Respondent::where('schema_id', $schema_id)->count();
        // GROUP BY
        $data['interviewed_respondents_by_gender'] = Respondent::where('schema_id', $schema_id)->where('interview_status', 'Interview Completed')->selectRaw('gender, COUNT(*) as count')->groupBy('gender')->get();

        $data['interviewed_respondents_by_county'] = Respondent::where('schema_id', $schema_id)->where('interview_status', 'Interview Completed')->selectRaw('county, COUNT(*) as count')->groupBy('county')->get();

        $data['interviewed_respondents_by_sub_county'] = Respondent::where('schema_id', $schema_id)->where('interview_status', 'Interview Completed')->selectRaw('sub_county, COUNT(*) as count')->groupBy('sub_county')->get();

        $data['interviewed_respondents_by_ward'] = Respondent::where('schema_id', $schema_id)->where('interview_status', 'Interview Completed')->selectRaw('ward, COUNT(*) as count')->groupBy('ward')->get();

        $data['interviewed_respondents_by_setting'] = Respondent::where('schema_id', $schema_id)->where('interview_status', 'Interview Completed')->selectRaw('setting, COUNT(*) as count')->groupBy('setting')->get();

        $data['interviewed_respondents_by_religion'] = Respondent::where('schema_id', $schema_id)->where('interview_status', 'Interview Completed')->selectRaw('religion, COUNT(*) as count')->groupBy('religion')->get();

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
