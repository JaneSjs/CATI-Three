<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRespondentRequest;
use App\Http\Requests\UpdateRespondentRequest;
use App\Imports\RespondentsImport;
use App\Jobs\ImportRespondents;
use App\Models\Interview;
use App\Models\Project;
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
     * List all respondents on the the system with their statistics.
     */
    public function index()
    {
        //$project = Project::find(2);

        $data['respondents'] = Respondent::orderBy('id', 'desc')->paginate(10);

        $total_respondents = Respondent::all();
        $data['total_respondents'] = count($total_respondents);
        $data['imported_today'] = Respondent::whereDate('created_at', Carbon::today())->count();
        $data['imported_yesterday'] = Respondent::whereDate('created_at', Carbon::yesterday())->count();

        $respondents_with_complete_interviews = Respondent::where('interview_status', 'Interview Completed')->get();
        $data['respondents_with_complete_interviews'] = count($respondents_with_complete_interviews);

        $male_respondents = Respondent::where('gender', 'male')->get();
        $data['male_respondents'] = count($male_respondents);

        $female_respondents = Respondent::where('gender', 'female')->get();
        $data['female_respondents'] = count($female_respondents);

        $respondents_with_feedback = Respondent::whereNotNull('feedback')->get();
        $data['respondents_with_feedback'] = count($respondents_with_feedback);

        $respondents_with_terminated_interviews = Respondent::where('interview_status', 'Interview Terminated')->get();
        $data['respondents_with_terminated_interviews'] = count($respondents_with_terminated_interviews);

        $locked_respondents = Respondent::where('interview_status', 'Locked')->get();
        $data['locked_respondents'] = count($locked_respondents);

        $respondents_available_for_interviewing = Respondent::where('interview_status', '!=', 'Locked')->whereNull('interview_date_time')->get();
        $data['respondents_available_for_interviewing'] = count($respondents_available_for_interviewing);

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
     * List all respondents on the the system 
     * that belong to a project with their statistics.
     */
    public function show($project_id)
    {
        $project = Project::find($project_id);

        $data['project_name'] = $project->name;

        $data['respondents'] = Respondent::where('project_id', $project_id)->orderBy('id', 'desc')->paginate(10);

        $data['total_respondents'] = count($project->respondents()->get());

        $data['imported_today'] = Respondent::where('project_id', $project_id)->whereDate('created_at', Carbon::today())->count();
        $data['imported_yesterday'] = Respondent::where('project_id', $project_id)->whereDate('created_at', Carbon::yesterday())->count();

        $male_respondents = $project->respondents()
                                    ->where('gender', 'male')
                                    //->orWhere('gender', 'm')
                                    ->get();
        $data['male_respondents'] = count($male_respondents);

        $female_respondents = $project->respondents()
                                    ->where('gender', 'female')
                                    //->orWhere('gender', 'f')
                                    ->get();
        $data['female_respondents'] = count($female_respondents);

        $data['respondents_with_complete_interviews'] = count($project->respondents()->where('interview_status', 'Interview Completed')->get());
        $data['respondents_with_feedback'] = count($project->respondents()->whereNotNull('feedback')->get());
        $data['respondents_with_terminated_interviews'] = count($project->respondents()->where('interview_status', 'Interview Terminated')->get());
        $data['locked_respondents'] = count($project->respondents()->where('interview_status', 'Locked')->get());

        $respondents_available_for_interviewing = $project->respondents()
                                                        ->where('interview_status', '!=', 'Locked')
                                                        ->whereNull('interview_date_time')
                                                        ->get();
        $data['respondents_available_for_interviewing'] = count($respondents_available_for_interviewing);

        return view('respondents.show', $data);
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
            return redirect()->back()->withErrors($importErrors)->withInput()->with('warning', 'Respondents Imported Partially. Please Check The Errors Below: ');    
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
        $survey_url = $request->input('iframe_url');

        $respondent = Respondent::find($respondent_id);
        //dd($respondent);
        $interview = Interview::find($interview_id);
        $survey = Schema::find($survey_id);
        $interview_status = $request->input('interview_status');
        //dd($request->input('iframe_url'));

        if ($interview_status == 'Interview Completed') {
            $status = 'success';
            $interview_date_time = Carbon::now();
        } elseif ($interview_status == 'Interview Terminated') {
            $status = 'danger';
            $interview_date_time = null;
        }

        $respondent->update([
            'id' => $respondent_id,
            'project_id' => $project_id,
            'schema_id' => $survey_id,
            'interview_date_time' => $interview_date_time,
            'interview_status' => $interview_status,
        ]);

        $interview->update([
            'id' => $interview_id,
            'end_time' => Carbon::now(),
            'interview_status' => $interview_status,
            'survey_url' => $survey_url
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
            'interview_date_time' => null
        ]);

        //dd($feedback);

        if ($feedback)
        {
            return to_route('projects.show',[$project_id],201)->with('success', 'Thanks For The Respondent feedback');
        }
        else
        {
            return back(201)->with('error', 'Oops! The feedback hasn\'t been captured');
        }
    }

    /**
     * Search for respondents
     */
    function search_respondents(Request $request)
    {
        $query = $request->input('query');

        $data['respondents'] = Respondent::search($query)->paginate(10);

        return view('respondents.search', $data);
    }
}
