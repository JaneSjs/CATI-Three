<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultApiController extends Controller
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
        $content   = json_encode($request->content);
        $user_id   = (int) $request->input('user_id');
        $schema_id = (int) $request->input('survey_id');
        $latitude = (int) $request->input('latitude');
        $longitude = (int) $request->input('longitude');
        $altitude = (int) $request->input('altitude');
        $altitude_accuracy = (int) $request->input('altitude_accuracy');
        $position_accuracy = (int) $request->input('position_accuracy');
        $heading = (int) $request->input('heading');
        $speed = (int) $request->input('speed');
        $timestamp = (int) $request->input('timestamp');
        //dd($user_id);

        $result = Result::create([
            'user_id'     => $user_id,
            'schema_id'   => $schema_id,
            'ip_address'  => $request->ip(),
            'mac_address' => '',
            'user_agent'  => $request->userAgent(),
            'latitude'    => $latitude,
            'longitude'   => $longitude,
            'altitude'    => $altitude,
            'altitude_accuracy'   => $altitude_accuracy,
            'position_accuracy'   => $position_accuracy,
            'heading'     => $heading,
            'speed'       => $speed,
            'timestamp'   => $timestamp,
            'content'     => $content,
        ]);

        if ($result) {
            // $result->users()->sync($request->user_id);
            // $result->schemas()->sync($request->survey_id);

            // You can do something here
           return response()->json($result, 201);
        } else {
            // You can send email and/or sms notification
           return response()->json($result, 500);
        }
    }

    /**
     * Pull the specified survey results.
     */
    public function show(int $id)
    {
        $result = Result::where('schema_id', $id)->get('content');

        //dd($result);

        return response()->json($result, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $survey_result = Result::find($id);

        $content = $request->input('content');



        $result = $survey_result->update([
            'id' => $id,
            'user_id' => auth()->user()->id,
            'survey_schema_id' => 1,
            // 'ip_address' => $request->ip(),
            // 'user_agent' => $request->userAgent(),
            'content' => $content,
        ]);

        return response()->json($result, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
