<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveySchemaRequest;
use App\Http\Requests\UpdateSurveySchemaRequest;
use App\Http\Resources\SurveySchemaResource;
use App\Models\SurveySchema;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Store survey name into the database
     */
    public function store(StoreSurveySchemaRequest $request): RedirectResponse
    {
        //dd($request);
        $survey = SurveySchema::create([
            'stage' => 'Draft',
            'survey_name' => $request->input('survey_name'),
        ]);
        

        if ($survey) {
            $survey->users()->attach(auth()->user()->id);
            $survey->projects()->attach($request->input('project_id'));

           return redirect()->back()->with('success', 'Survey Has Been Created Successfully');
        } else {
            // Send Email Notification
           return redirect()->back()->with('warning', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveySchema $survey)
    {
        //dd('Here');
        if ($survey) {
            $data['survey'] = $survey;

            //dd($data);

            return view('surveys.show', $data);
        } else {
            return redirect()->route('surveys.index')->with('error', 'That survey was not found');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveySchema $survey)
    {
        $data['survey'] = $survey;
        //dd($data);

        return view('surveys.edit', $data);
    }

    /**
     * Update the Survey Schemas in storage.
     */
    public function update(Request $request)
    {

        $survey = SurveySchema::find($request->id);
        
        if ($survey) {
            $survey->user_id = auth()->user()->id;
            $survey->project_id = $request->input('project_id');
            $survey->stage = $request->input('stage');
            $survey->updated_by = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $survey->save();

            //dd($survey);

            return response()->json([
                'message' => 'Survey Schema Updated Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Survey Schema was not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveySchema $survey)
    {
        //
    }

}
