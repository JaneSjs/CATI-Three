<?php

namespace App\Http\Controllers;

use App\Models\SurveyResult;
use Illuminate\Http\Request;

class SurveyResultApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd(auth()->user()->id());
        $content = json_encode($request->content);
        //dd($content);

        $surveyResult = SurveyResult::create([
            // 'user_id' => $request->user_id,
            //'survey_schema_id' => $request->survey_id,
            'ip_address' => $request->ip(),
            'mac_address' => '123abcd',
            'user_agent' => $request->userAgent(),
            'latitude' => 19,
            'longitude' => 34,
            'content' => $content,
        ]);

        if ($surveyResult) {
            $surveyResult->users()->sync($request->user_id);
            $surveyResult->survey_schemas()->sync($request->survey_id);

            // You can do something here
           return response()->json($surveyResult, 201);
        } else {
            // You can send email and/or sms notification
           return response()->json($surveyResult, 500);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $survey_result = SurveyResult::find($id);

        $content = $request->input('content');



        $surveyResult = $survey_result->update([
            'id' => $id,
            'user_id' => auth()->user()->id,
            'survey_schema_id' => 1,
            // 'ip_address' => $request->ip(),
            // 'user_agent' => $request->userAgent(),
            'content' => $content,
        ]);

        return response()->json($surveyResult, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
