<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Models\Interview;
use App\Models\Respondent;
use App\Models\Schema;
use Illuminate\Http\Request;

class InterviewController extends Controller
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
    public function store(StoreInterviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterviewRequest $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }

    /**
     * Begin Interview
     */
    public function begin_interview($id)
    {
        $data['surveys'] = Schema::where('project_id', $id)
                        ->where('stage', 'Production')
                        ->get();

        $data['project_id'] = $id;

        //dd($data);

        return view('interviews.begin', $data);
    }

    /**
     * Search for a respondent
     */
    public function search_respondent(Request $request)
    {
        //dd($request);
        $data['survey'] = Schema::find($request->input('survey_id'));
        $data['respondent'] = Respondent::where('project_id', $request->input('project_id'))
                                        ->where('region', 'EASTERN')
                                        ->first();
        dd($data);

        return view('interviews.details', $data);


    }
}
