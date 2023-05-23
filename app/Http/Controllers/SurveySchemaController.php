<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveySchemaRequest;
use App\Http\Requests\UpdateSurveySchemaRequest;
use App\Http\Resources\SurveySchemaResource;
use App\Models\SurveySchema;
use Exception;
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
    public function store(StoreSurveySchemaRequest $request)
    {
        //dd($request);
        $survey = SurveySchema::create([
            'user_id' => auth()->user()->id,
            'project_id' => $request->input('project_id'),
            'survey_name' => $request->input('survey_name'),
        ]);
        

        if ($survey) {
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
        $data['survey'] = $survey;

        return view('surveys.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveySchema $survey)
    {
        $data['survey'] = $survey;

        return view('surveys.edit', $data);
    }

    /**
     * Update the Survey Schemas in storage.
     */
    public function update(UpdateSurveySchemaRequest $request, SurveySchema $survey)
    {
        //dd($survey);
        try {
        $survey = $survey;

        $survey->save([
            //'id' => $request->id,
            'content' => $request->content,
            'version' => $request->version,
            'updated_by' => auth()->user()->first_name . auth()->user()->last_name
        ]);

        //dd($survey);

        return response()->json([
            'message' => 'Survey Schema Updated Successfully'
        ]);
        } catch(Exception $e) {
            return response()->json([
                'message' => 'Survey Schema Failed To Be Updated'
            ]);
        
}    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveySchema $survey)
    {
        //
    }

}
