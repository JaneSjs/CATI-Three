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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class RespondentController extends Controller
{
    /**
     * List all respondents on the system 
     * with their statistics.
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

    public function show(Respondent $respondent)
    {
        $data['respondent'] = $respondent;

        return view('respondents.showw', $data);
    }

    
    /**
     * List all respondents on the the system 
     * that belong to a project and survey with their statistics.
     */
    public function project_survey_respondents($projectId, $surveyId)
    {
        //dd($projectId . '-' . $surveyId);
        if($projectId !== null)
        {
            $project = Project::find($projectId);

            $data['project'] = $project;
            $respondents = $project->respondents()->orderBy('id', 'desc')->paginate(10);
            //dd($respondents);
            $data['respondents'] = $respondents;
        }

        if ($surveyId !== null)
        {
            $survey  = Schema::find($surveyId);

            $data['survey'] = $survey;
            $respondents = $survey->respondents()->orderBy('id', 'desc')->paginate(10);
            //dd($respondents);
            $data['respondents'] = $respondents;
        }

        $data['total_respondents'] = count($survey->respondents()->get());
        $data['trashedRespondents'] = count($survey->respondents()->onlyTrashed()->get());

        $data['imported_today'] = Respondent::where('schema_id', $surveyId)->whereDate('created_at', Carbon::today())->count();
        $data['imported_yesterday'] = Respondent::where('schema_id', $surveyId)->whereDate('created_at', Carbon::yesterday())->count();

        $male_respondents = $survey->respondents()
                                        ->where('gender', 'male')
                                        //->orWhere('gender', 'm')
                                        ->get();
        $data['male_respondents'] = count($male_respondents);

        $female_respondents = $survey->respondents()
                                        ->where('gender', 'female')
                                        //->orWhere('gender', 'f')
                                        ->get();
        $data['female_respondents'] = count($female_respondents);

        $data['respondents_with_complete_interviews'] = count($survey->respondents()->where('interview_status', 'Interview Completed')->get());
        $data['respondents_with_feedback'] = count($survey->respondents()->whereNotNull('feedback')->get());
        $data['respondents_with_terminated_interviews'] = count($survey->respondents()->where('interview_status', 'Interview Terminated')->get());
        $data['locked_respondents'] = count($survey->respondents()->where('interview_status', 'Locked')->get());

        $available_for_interviewing = $survey
                                        ->respondents()
                                        ->where('interview_status', '!=', 'Locked')
                                        ->whereNull('interview_date_time')
                                        ->get();
        $data['available_for_interviewing'] = count($available_for_interviewing);

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
        if ($respondent) {
            $respondent->delete();
            return redirect()->back()->with('success', 'Respondent Removed From The Database.');
        }

        return redirect()->back()->with('error', 'Respondent wasn\'t found, thus wasn\'t deleted');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function forceDelete(Request $request)
    {
        $id = $request->input('id');

        $respondent = Respondent::onlyTrashed()->find($id);

        if ($respondent) {
            $respondent->forceDelete();
            return back()->with('success', 'Respondent Permanently Removed From The System.');
        }

        return back()->with('error', 'Respondent wasn\'t found, thus no action was taken');
    }

    /**
     * Bulk Soft Delete Respondents
     */
    public function bulkSoftDelete(Request $request)
    {
        //dd($request);
        $schemaId = $request->input('survey_id');
        $projectId = $request->input('projectId');

        if ($schemaId !== null) {
            Respondent::where('schema_id', $schemaId)->delete();
            // Notify The Project Manager Via Email
            return back()->with('success', 'Survey Respondents Have Now Been Removed From The Database');
        }
        elseif ($projectId !== null) {
            Respondent::where('project_id', $projectId)->delete();
            // Notify The Project Manager Via Email
            return back()->with('success', 'Project Respondents Have Now Been Removed From The Database');
        }
        else
        {
            //Respondent::truncate();
            return back()->with('error', 'Respondents Have Not Been Removed Due To Unknown Reasons');
        }
    }

    /**
     * Bulk Permanent Delete Respondents
     */
    public function bulkPermanentDelete(Request $request)
    {
        //dd($request);
        $schemaId = $request->input('survey_id');
        $projectId = $request->input('projectId');

        if ($schemaId !== null)
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Respondent::onlyTrashed()
                        ->where('schema_id', $schemaId)
                        ->forceDelete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Notify The DPO Via Email
            return back()->with('success', 'Survey Respondents Have Now Been Completeley Removed From The System');
        }
        
        if ($projectId !== null)
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Respondent::onlyTrashed()
                        ->where('project_id', $projectId)
                        ->forceDelete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Notify The DPO Via Email
            return back()->with('success', 'Project Respondents Have Now Been Removed From The System');
        }
        
        //Respondent::truncate();
        return back()->with('error', 'Respondents Have Not Been Removed Due To Unknown Reasons');
    }

    /**
     * Soft Deleted Respondents
     */
    public function softDeletedRespondents($project_id, $survey_id)
    {
        //dd($project_id . '-' . $survey_id);
        if($project_id !== null)
        {
            $project = Project::find($project_id);

            $data['project'] = $project;
            $respondents = $project
                                ->respondents()
                                ->onlyTrashed()
                                ->orderBy('id', 'desc')
                                ->paginate(10);
            //dd($respondents);
            $data['respondents'] = $respondents;
        }

        if ($survey_id !== null) {
            $survey  = Schema::find($survey_id);

            $data['survey'] = $survey;
            $respondents = $survey
                            ->respondents()
                            ->onlyTrashed()
                            ->orderBy('id', 'desc')
                            ->paginate(10);
            //dd($respondents);
            $data['respondents'] = $respondents;
        }

        $data['total_respondents'] = count($survey->respondents()->get());
        $data['trashedRespondents'] = count($survey->respondents()->onlyTrashed()->get());

        $data['imported_today'] = Respondent::onlyTrashed()->where('schema_id', $survey_id)->whereDate('created_at', Carbon::today())->count();
        $data['imported_yesterday'] = Respondent::onlyTrashed()->where('schema_id', $survey_id)->whereDate('created_at', Carbon::yesterday())->count();

        $male = $survey->respondents()
                                    ->onlyTrashed()->where('gender', 'male')
                                    //->orWhere('gender', 'm')
                                    ->get();
        $data['male'] = count($male);

        $female = $survey->respondents()
                                    ->onlyTrashed()->where('gender', 'female')
                                    //->orWhere('gender', 'f')
                                    ->get();
        $data['female'] = count($female);

        $data['with_complete_interviews'] = count($survey->respondents()->where('interview_status', 'Interview Completed')->get());
        $data['with_feedback'] = count($survey->respondents()->whereNotNull('feedback')->get());
        $data['with_terminated_interviews'] = count($survey->respondents()->where('interview_status', 'Interview Terminated')->get());
        $data['locked'] = count($survey->respondents()->where('interview_status', 'Locked')->get());

        $available_for_interviewing = $survey
                                        ->respondents()
                                        ->where('interview_status', '!=', 'Locked')
                                        ->whereNull('interview_date_time')
                                        ->get();
        $data['available_for_interviewing'] = count($available_for_interviewing);

        return view('respondents.soft_deleted', $data);
        
    }

    /**
     * Restore soft deleted respondents
     */
    public function restoreRespondents()
    {
        dd('Implement Restoration Here');
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
        ],
        [
            'bulk_respondents.required' => 'That was an empty file upload. Please select a file',
            'bulk_respondents.file' => 'Invalid file format. Please upload a valid Spreadsheet file',
            'bulk_respondents.mimes' => 'Invalid file format. Please upload a Spreadsheet file.'
        ]);

        $path = $request->file('bulk_respondents')->store('imports');
        //dd($path);

        // Clear any previous import errors
        Session::forget('respondents_import_errors');

        // Dispatch Respondents Import Job
        ImportRespondents::dispatch($path);
        
        //$this->respondents_import_job($path);

        // Check if there were any import errors
        $importErrors = Session::get('respondents_import_errors', []);

        if (!empty($importErrors))
        {
            return back()->withErrors($importErrors)->withInput()->with('warning', 'Respondents Imported Partially. Please Check The Errors Below: ');    
        }

        return back()->with('info', 'Respondents Are Being Imported In The Background');
        
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
            return to_route('projects.show',[$project_id],201)->with('success', 'Thanks For The Feedback');
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

    /**
     * Unlock Respondents
     */
    public function unlockRespondents(Request $request)
    {
        $surveyId = $request->input('surveyId');

        $unlockRespondents = Respondent::where('schema_id', $surveyId)
        ->where('interview_status', 'Locked')
        ->update([
            'interview_status' => 'Unlocked',
            'interview_date_time' => null
        ]);

        //dd($unlockRespondents);

        if ($unlockRespondents > 0)
        {
            return back()->with('success', $unlockRespondents . ' Respondents Unlocked');
        }
        else
        {
            return back()->with('info', 'No Locked Respondents Found');
        }

    }
}
