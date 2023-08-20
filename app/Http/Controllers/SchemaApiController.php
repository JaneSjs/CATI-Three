<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchemaResource;
use App\Models\Result;
use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['surveys'] = Schema::all();

        return response($data, 200)
                    ->header('Content-Type', 'application/json');
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
        $data['survey']  = Schema::select('content')
                            ->findOrFail($id);

        //return $data;
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $survey = Schema::find($request->id);
        
        if ($survey) {
            $survey->content = $request->content;
            $survey->version = $request->version;
            $survey->updated_by = $request->user;
            $survey->save();

            //dd($survey);

            return response()->json([
                'message' => 'Survey Schema Updated Successfully'
            ], 201);
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
