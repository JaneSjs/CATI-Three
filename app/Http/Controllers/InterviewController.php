<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Models\Interview;
use App\Models\Project;
use App\Models\Quota;
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
        //dd($request->input('respondent_id'));
        $begin_interview = route('begin_interview', [
            'project_id' => $request->input('project_id'),
            'survey_id' => $request->input('survey_id'),
            'interview_id' => 0
        ]);

        $begin_survey = route('begin_survey', [
            'project_id' => $request->input('project_id'),
            'survey_id' => $request->input('survey_id'),
            'interview_id' => 0,
            'respondent_id' => $request->input('respondent_id'),
        ]);
        
        $interview = Interview::create([
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
        
        if ($interview) {
            $begin_survey = route('begin_survey', [
                'project_id' => $request->input('project_id'),
                'survey_id' => $request->input('survey_id'),
                'interview_id' => $interview->id,
                'respondent_id' => $request->input('respondent_id'),
            ]);

            return redirect($begin_survey, 201);
        } else {
            // Send Email Notification
           return redirect($begin_interview, 500)->with('warning', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        $data['interview'] = $interview;
        //dd($data);

        if ($interview->result) {
            $data['result'] = $interview->result;
            //dd($data);
        }
        //dd($data);

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
        $status = $interview->update([
            'qcd_by' => auth()->id(),
            'status' => $request->input('status')
        ]);

        if ($status) {
            return back(201)->with('success', 'Your QC has been Recorded Successfully');
        } else {
            return back()->with('danger', 'Something went wrong. Your QC has not been Recorded Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }

    /**
     * Begin Interview i.e search for a respondent to be interviewed
     * during the survey
     */
    public function begin_interview($project_id, $survey_id, $interview_id)
    {
        $data['project'] = Project::find($project_id);

        $data['survey']  = Schema::find($survey_id);

        $data['respondent'] = null;

        $data['project_id'] = $project_id;
        $data['interview_id'] = $interview_id;

        //dd($data);

        return view('interviews.begin', $data);
    }

    /**
     * Begin Survey i.e display survey questionnaire
     */
    public function begin_survey(Request $request, $project_id, $survey_id, $interview_id, $respondent_id)
    {
        session()->flash('info', ' Kindly allow Geolocation Access On Your Browser in Order For The Survey Results To Be Submitted Successfully. Wait for the Results Submitted Successfully Notification which confirms that your interview has been captured Successfully before leaving the page. ');

        $respondent = Respondent::find($respondent_id);

        if ($respondent) {
            /**
             * Lock the Respondent so that they can't be searchable
             * while they are being interviewed
             */
            $status = 'Locked';

            $respondent->update([
                'id' => $respondent_id,
                'project_id' => $project_id,
                'schema_id' => $survey_id,
                'interview_date_time' => Carbon::now(),
                'interview_status' => $status
            ]);

            $data['project'] = Project::find($project_id);
            $data['survey'] = Schema::find($survey_id);
            $data['interview'] = Interview::find($interview_id);
            $data['respondent_id'] = $respondent_id;

            //dd($data['survey']);

            if ($data['project'] && $data['survey'] && $data['interview'] && $data['respondent_id']) {
                return view('surveys.show', $data);
            } else {
                return to_route('projects.index')->with('warning', 'Project, Survey, Interview, and Respondent have not been found');
            }
        }
    }

    /**
     * Check if the quotas are met.
     */
    private function areQuotasMet($schema_id, $quotaCriteria)
    {
        // Initialize an array to store the attributes that have met their quotas
        $metAttributes = [];

        // Fetch the target count of attributes whose quota has been set.
        foreach ($quotaCriteria as $attribute => $criteria)
        {
            if (isset($criteria))
            {      
                $InterviewedRespondents = Respondent::where('schema_id', $schema_id)
                ->where('interview_status', 'Interview Completed')
                ->count();

                /**
                 *Check if the count of interviewed respondents 
                 * has reached the target interviews set on the quota criteria.
                 */
                if ($InterviewedRespondents >= $criteria) {
                    // Quota met for this attribute
                    $metAttributes[$attribute] = $InterviewedRespondents;
                }
            } elseif (!isset($$attribute)) {
                // Quota Criterion not set
                $metAttributes[$attribute] = null;
            }

        }
        
        // Return the array of attributes that have met quotas
        return $metAttributes;
    }

    /**
     * Search for a respondent
     */
    function search_respondent(Request $request)
    {
        $data['respondent'] = null;
        $project_id = $request->input('project_id');
        $survey_id = $request->input('survey_id');

        $query = $request->get('query');

        $respondent = Respondent::search($query)->first();

        $data['respondent'] = $respondent;

        $data['project'] = Project::find($project_id);

        $data['survey'] = Schema::find($survey_id);
        $data['interview_id'] = $request->input('interview_id');

        //dd($data);

        return view('interviews.begin', $data);
    }


    /**
     * Search for a respondent
     */
    // public function search_respondent(Request $request)
    // {
    //     $current_date = Carbon::now();
    //     // Default value
    //     $difference_in_days = 59;

    //     $data['respondent'] = null;
    //     $project_id = $request->input('project_id');
    //     $survey_id = $request->input('survey_id');

    //     $query = $request->get('query');

    //     /**
    //     *  Fetch Quota Criteria
    //     */
    //     $quotaCriteria = Quota::survey_quota_criteria($survey_id);
    //     //dd($quotaCriteria);

        

    //     if ($difference_in_days > 60)
    //     {
    //         //dd('Here');
    //         session()->flash('info', 'Found Respondent(s) have Interview Fatigue. 😩');
    //         $data['respondent'] = null;
    //     }
    //     else
    //     {
    //         //dd('Here');
    //         if (!empty($quotaCriteria))
    //         {
    //             //dd($quotaCriteria);
    //             /**
    //              * Pull a Respondent Based on the Quota Constraints i.e 
    //              * if some quota criteria have been met, only pull eligible 
    //              * respondents with unmet quota attributes 
    //             */ 
    //             $metAttributes = $this->areQuotasMet($survey_id, $quotaCriteria);

    //             if (!empty($metAttributes))
    //             {
    //                 dd($metAttributes);
    //                 foreach ($metAttributes as $attribute => $InterviewedRespondents)
    //                 {
    //                     if ($InterviewedRespondents !== null)
    //                     {
    //                         // Fetch respondents with unmet quota attributes
    //                         $respondent = Respondent::search($query)->first();

    //                         $last_interview_date = Carbon::parse($respondent->interview_date_time);

    //                         $difference_in_days = $current_date->diffInDays($last_interview_date);

    //                         if ($difference_in_days > 60)
    //                         {
    //                             if ($respondent->interview_status == 'Locked')
    //                             {
    //                                 session()->flash('info', 'That Respondent is Currently Locked to another Interview. 🤙🏿');
    //                             }

    //                             $data['respondent'] = $respondent;
    //                         }
    //                         else
    //                         {
    //                             session()->flash('info', 'Found Respondent(s) have Interview Fatigue. 😩');
    //                         }

    //                         session()->flash('warning', ucfirst($attribute) . 'Quota has been met' . $InterviewedRespondents . ' ' . ucfirst($attribute) . 's already interviewed');
    //                     }
    //                 }

    //                 $data['respondent'] = null;
    //             }
    //             else
    //             {
    //                 //dd('No Quota Met for any set attributes');
    //                 // If there are no met attributes, fetch an eligible respondent for an interview. 
    //                 $respondent = Respondent::search($query)->first();

    //                 if ($respondent && $respondent->interview_date_time)
    //                 {
    //                    $last_interview_date = Carbon::parse($respondent->interview_date_time);

    //                     $difference_in_days = $current_date->diffInDays($last_interview_date);
    //                 }
    //                 else
    //                 {
    //                     $difference_in_days = 61;
    //                 }

                    

    //                 if ($difference_in_days > 60)
    //                 {
    //                     //dd('here');
    //                     if ($respondent && $respondent->interview_status == 'Locked')
    //                     {
    //                         session()->flash('info', 'That Respondent is Currently Locked to another Interview. 🤙🏿');
    //                     }

    //                     // There is a problem here. Check it out
    //                     $data['respondent'] = $respondent;
    //                     //dd($respondent);
    //                 }
    //                 else
    //                 {
    //                     session()->flash('info', 'Found Respondent(s) have Interview Fatigue. 😩');
    //                 }

    //                 $data['respondent'] = $respondent;
    //             }
                        
    //         }
    //         else
    //         {
    //             /**
    //              *  Quota criteria not set, fetch any respondent and determine 
    //              *  for their eligibility to participate in an interview
    //              *  for an interview.
    //              * 
    //              *  Eligible respondents don't have interview fatigue i.e
    //              *  interview period is not less than 60 days.
    //              */
    //             $respondent = Respondent::search($query)
    //                                             ->first();

    //             if ($respondent != null)
    //             {

    //                 $last_interview_date = Carbon::parse($respondent->interview_date_time);

    //                 $difference_in_days = $current_date->diffInDays($last_interview_date);

    //                 if ($difference_in_days > 60)
    //                 {
    //                     if ($respondent->interview_status == 'Locked')
    //                     {
    //                         session()->flash('info', 'That Respondent is Currently Locked to another Interview. 🤙🏿');
    //                     }

    //                     $data['respondent'] = $respondent;
    //                 }
    //                 else
    //                 {
    //                     session()->flash('info', 'Found Respondent(s) have Interview Fatigue. 😩');
    //                 }

    //             }
                    
    //             return redirect()->back()->with('info', 'Search index is empty or respondents database is exhausted.');
    //         }
    //     }
        

    //     $data['project'] = Project::find($project_id);

    //     $data['survey'] = Schema::find($request->input('survey_id'));
    //     $data['interview_id'] = $request->input('interview_id');

    //     //dd($data);

    //     return view('interviews.begin', $data);

    // }

    /**
     * Display the specified resource.
     */
    public function coding($id)
    {
        $interview = Interview::find($id);

        if ($interview) {
            $data['interview'] = $interview;

            if ($interview->result != null) {
                $data['result'] = $interview->result;
                //dd($data);
            }
        } else {
            return to_route('projects.index')->with('error', 'That Interview Was Not Found');
        }

        return view('interviews.coding', $data);
    }
}
