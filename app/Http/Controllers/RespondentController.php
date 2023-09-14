<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRespondentRequest;
use App\Http\Requests\UpdateRespondentRequest;
use App\Imports\RespondentsImport;
use App\Jobs\ImportRespondents;
use App\Models\Interview;
use App\Models\Respondent;
use App\Models\Schema;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class RespondentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['respondents'] = Respondent::paginate(10);
        $data['total_respondents'] = count(Respondent::all());

        return view('respondents.index', $data);
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
    public function store(StoreRespondentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Respondent $respondent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Respondent $respondent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRespondentRequest $request, $respondent_id, $project_id, $schema_id, $status)
    {
        $respondent = Respondent::find($respondent_id);
        //dd($respondent);

        if ($respondent) {
            $respondent->update([
                'project_id' => $project_id,
                'schema_id' => $schema_id,
                'interview_date_time' => Carbon::now(),
                'interview_status' => $status
            ]);

            return response()->json(['status' => $respondent->name . "'s interview status captured Successfully"], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'Respondent not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Respondent $respondent)
    {
        //
    }

    /**
     * Show Respondents Import Page
     */
    public function import()
    {
        return view('respondents.import');
    }

    public function xlsx_import(Request $request): RedirectResponse
    {
        $request->validate([
            'bulk_respondents' => 'required|file|mimes:xlsx',
        ]);

        $path = $request->file('bulk_respondents')->store('imports');
        //dd($path);

        // Clear any previous import errors
        Session::forget('respondents_import_errors');

        Excel::import(new RespondentsImport, storage_path('app/' . $path), null, \Maatwebsite\Excel\Excel::XLSX, function ($reader)
        {
            $reader->ignoreEmpty();
        });
        
        //$this->respondents_import_job($path);

        // Check if there were any import errors
        $importErrors = Session::get('respondents_import_errors', []);

        if (!empty($importErrors))
        {
            return redirect()->back()->withErrors($importErrors)->withInput()->with('warning', 'Respondents Import Failed. Please Check The Errors Below:');    
        }

        return redirect()->back()->with('info', 'Respondents Are Being Imported In The Background');
        
    }

    public function respondents_import_job($path)
    {
        //dd($path);
        ImportRespondents::dispatch($path);
    }

    /**
     * Update Respondent and their Interview Status
     */
    public function updateRespondentInterviewStatus(Request $request)
    {
        //dd($request);
        $respondent_id = $request->input('respondent_id');
        $project_id = $request->input('project_id');
        $survey_id = $request->input('survey_id');
        $interview_id = $request->input('interview_id');

        $respondent = Respondent::find($respondent_id);
        //dd($respondent);
        $interview = Interview::find($interview_id);
        $survey = Schema::find($survey_id);
        $interview_status = $request->input('interview_status');
        //dd($request->input('iframe_url'));

        if ($interview_status == 'Interview Completed') {
            $status = 'success';
        } elseif ($interview_status == 'Interview Terminated') {
            $status = 'danger';
        }

        $respondent->update([
            'id' => $respondent_id,
            'project_id' => $project_id,
            'schema_id' => $survey_id,
            'interview_date_time' => Carbon::now(),
            'interview_status' => $request->input('interview_status'),
        ]);

        $interview->update([
            'id' => $interview_id,
            'end_time' => Carbon::now(),
            'interview_status' => $request->input('interview_status'),
            'survey_url' => $request->input('iframe_url')
        ]);

        return to_route('projects.show', ['project' => $project_id])->with($status, $interview_status);
    }

    /**
     * Capture Respondent Feedback
     */
    function respondent_feedback(Request $request)
    {
        $respondent_id = $request->input('respondent_id');
        $project_id = $request->input('project_id');

        $respondent = Respondent::find($respondent_id);

        $feedback = $respondent->update([
            'feedback' => $request->input('feedback'),
            'interview_status' => 'Unlocked On Feedback',
        ]);

        //dd($feedback);

        if ($feedback)
        {
            return to_route('projects.show',[$project_id],201)->with('success', 'Thanks for Capturing The Respondent feedback');
        }
        else
        {
            return back(201)->with('error', 'Oops! The feedback hasn\'t been captured');
        }
    }
}
