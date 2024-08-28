<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Models\Respondent;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['results'] = Result::all();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        //dd(auth()->user()->id);
        $content      = json_encode($request->content);
        $user_id      = (int) $request->input('user_id');
        $schema_id    = (int) $request->input('survey_id');
        $interview_id = (int) $request->input('interview_id');
        $project_id   = (int) $request->input('project_id');
        $respondent_id     = (int) $request->input('respondent_id');
        $latitude     = (int) $request->input('latitude');
        $longitude    = (int) $request->input('longitude');
        $altitude     = (int) $request->input('altitude');
        $altitude_accuracy = (int) $request->input('altitude_accuracy');
        $position_accuracy = (int) $request->input('position_accuracy');
        $heading   = (int) $request->input('heading');
        $speed     = (int) $request->input('speed');
        $timestamp = (int) $request->input('timestamp');
        //dd($project_id);

        $result = Result::create([
            'user_id'     => $user_id,
            'schema_id'   => $schema_id,
            'interview_id'   => $interview_id,
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
            // Update Respondent 'interview_status' and 'interview_date_time' columns here

            $this->updateRespondentInterviewStatus($respondent_id, $project_id);

           return response()->json([
            'id' => $result->id,
            'message' => 'Survey Results Stored Successfully'
           ], 201);
        } else {
            // You can send email and/or sms notification
           return response()->json([
            'message' => 'Failed To Store Survey Results.'
           ], 500);
        }
    }

    /**
     * Pull the specified survey results.
     */
    public function show(int $id)
    {
        //dd($id);
        $data['result'] = Result::where('interview_id', $id)
        ->get('content');
        //->first();

        //dd($data);
        //return $data;

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd('Patch');
        //dd(auth()->user()->id);
        $content      = json_encode($request->content);
        $user_id      = (int) $request->input('user_id');
        $schema_id    = (int) $request->input('survey_id');
        $interview_id = (int) $request->input('interview_id');
        $project_id   = (int) $request->input('project_id');
        $respondent_id     = (int) $request->input('respondent_id');
        $latitude     = (int) $request->input('latitude');
        $longitude    = (int) $request->input('longitude');
        $altitude     = (int) $request->input('altitude');
        $altitude_accuracy = (int) $request->input('altitude_accuracy');
        $position_accuracy = (int) $request->input('position_accuracy');
        $heading   = (int) $request->input('heading');
        $speed     = (int) $request->input('speed');
        $timestamp = (int) $request->input('timestamp');
        //dd($project_id);

        $result = Result::where('interview_id', $interview_id)
                        ->where('user_id', $user_id)
                        ->first();

        if ($result) {

            $result->update([
                'content'     => $content,
            ]);

            // Update Respondent 'interview_status' and 'interview_date_time' columns here

            $this->updateRespondentInterviewStatus($respondent_id, $project_id);

           return response()->json([
            'id' => $result->id,
            'message' => 'Survey Results Updated Successfully'
           ], 201);
        } else {
            // You can send email and/or sms notification
           return response()->json([
            'message' => 'Failed To Update Survey Results.'
           ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateRespondentInterviewStatus($respondent_id, $project_id)
    {
        $respondent = Respondent::find($respondent_id);
        //dd($respondent);
        $respondent->update([
            'id' => $respondent_id,
            'project_id' => $project_id,
            'interview_date_time' => Carbon::now(),
            'interview_status' => 'Interview Completed'
        ]);
    }
}
