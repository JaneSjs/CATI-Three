<?php

namespace App\Http\Controllers;

use App\Http\Resources\SurveySchemaResource;
use App\Models\SurveySchema;
use Illuminate\Http\Request;

class SurveySchemaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['surveys'] = SurveySchema::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['survey'] = SurveySchema::select('content')
                                        ->findOrFail($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $survey = SurveySchema::find($request->id);
        
        if ($survey) {
            $survey->content = $request->content;
            $survey->version = $request->version;
            $survey->updated_by = $request->user;
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
    public function destroy(string $id)
    {
        //
    }
}
