<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Models\Interview;
use App\Models\Project;
use App\Models\Respondent;
use App\Models\Schema;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreInterviewRequest $request)
    {
        $survey_page = route('surveys.show', $request->input('survey_id'));
        
        $project = Interview::create([
            'user_id' => auth()->id(),
            'project_id' => $request->input('project_id'),
            'schema_id' => $request->input('survey_id'),
            'respondent_id' => $request->input('respondent_id'),
            'respondent_name' => $request->input('respondent_name'),
            'ext_no' => $request->input('ext_no'),
            'phone_called' => $request->input('phone_called'),
            'start_time' => Carbon::parse($request->date('start_time')),
        ]);

        //dd($project);
        
        if ($project) {
            return redirect($survey_page, 201);
        } else {
            // Send Email Notification
           return redirect($survey_page, 500)->with('warning', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        $data['interview'] = $interview;

        return view('interviews.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterviewRequest $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }

    /**
     * Begin Interview
     */
    public function begin_interview($id)
    {
        $data['project'] = Project::where('id', $id)->first();

        $data['surveys'] = Schema::where('project_id', $id)
                        ->where('stage', 'Production')
                        ->get();

        $data['respondent'] = null;

        $data['project_id'] = $id;

        //dd($data);

        return view('interviews.begin', $data);
    }

    /**
     * Search for a respondent
     */
    public function search_respondent(Request $request)
    {
        $interview_period = 0;
        $data['respondent'] = null;

        

        if ($query = $request->get('query'))
        {
            $respondent = Respondent::search($query)
                                            ->first();

            if ($respondent != null) {
                if ($respondent->interview_date_time == null)
                {
                    $data['respondent'] = $respondent;
                }
                else
                {
                    $last_interview_date = Carbon::parse($respondent->interview_date_time);

                    $current_date = Carbon::now();

                    $difference_in_days = $current_date->diffInDays($last_interview_date);

                    if ($difference_in_days > 60) {
                        $data['respondent'] = $respondent;
                    }
                }
            } else {
                return redirect()->back()->with('info', 'Search index is empty. Import existing Respondents to the search indexes');
            }
            
            

        }

        $data['project'] = Project::where('id', $request->input('project_id'))->first();

        $data['surveys'] = Schema::where('project_id', $request->input('project_id'))
                        ->where('stage', 'Production')
                        ->get();

        //dd($data);

        return view('interviews.begin', $data);

    }
}
