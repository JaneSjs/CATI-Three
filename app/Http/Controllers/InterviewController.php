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
    private function areQuotasMet($schema_id, $respondent, $quotaCriteria)
    {
        // Initialize an array to store the attributes that have met their quotas
        $metAttributes = [];

        // Fetch the target count of attributes whose quota has been set.
        foreach ($quotaCriteria as $attribute => $criteria)
        {
            if (isset($criteria[$respondent->{$attribute}]))
            {
                    
                $InterviewedRespondents = Respondent::where('status', 'Interview Completed')
                                                ->where('schema_id', $schema_id)
                                                ->where($attribute, $respondent->{$attribute})
                                                ->count();

                /**
                 *Check if the count of interviewed respondents 
                 * has reached the target count for this attribute
                 *  as set on the quota criteria.
                 */
                if ($InterviewedRespondents >= $criteria[$respondent->{$attribute}]) {
                    // Quota met for this attribute
                    $metAttributes[$attribute] = $InterviewedRespondents;
                }
            } elseif (!isset($respondent->$attribute)) {
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
    public function search_respondent(Request $request)
    {
        //$interview_period = 0;
        $data['respondent'] = null;
        $project_id = $request->input('project_id');
        $survey_id = $request->input('survey_id');

        $query = $request->get('query');

        /**
        *  If Quota Criteria has been set, 
        * check if the Quota has been Met
        */
        $quotaCriteria = Quota::survey_quota_criteria($survey_id);
        //dd($quotaCriteria);

        if (!empty($quotaCriteria)) {
            // Pull a Respondent Based on the Quota Criteria
            $respondent = Respondent::where(function ($query) {
                $query->where('interview_status', '!=', 'Interview Completed')
                      ->orWhere(function ($query) {
                            $query->where('interview_status', 'Interview Completed')
                                  ->where(function ($query) {
                                      $query->whereDate('interview_date_time', '<=', Carbon::now()->subDays(60));
                                  });
                      });
            })
            ->search($query)
            ->first();

        // If some quota criteria have been met, pull respondents with unmet quota attributes 
        $metAttributes = $this->areQuotasMet($survey_id, $respondent, $quotaCriteria);

        if (!empty($metAttributes)) {
            foreach ($metAttributes as $attribute => $InterviewedRespondents) {
                if ($InterviewedRespondents !== null) {
                    session()->flash('warning', ucfirst($attribute) . 'Quota has been met' . $InterviewedRespondents . ' ' . ucfirst($attribute) . 's already interviewed');
                }
            }

            $data['respondent'] = null;
        } else {
            // If there are no met attributes, then the respondent is eligible for an interview
            $data['respondent'] = $respondent;
        }
                



            // If some quota criteria have been met, pull respondents with unmet quota attributes 
            $metAttributes = $this->areQuotasMet($survey_id, $respondent, $quotaCriteria);

            if (!empty($metAttributes)) {
                foreach ($metAttributes as $attribute => $InterviewedRespondents) {
                    if ($InterviewedRespondents !== null) {
                        session()->flash('warning', ucfirst($attribute) . 'Quota has been met' . $InterviewedRespondents . ' ' . ucfirst($attribute) . 's already interviewed');
                    }
                }

                $data['respondent'] = null;
            } else {
                // If there are no met attributes, then the respondent is eligible for an interview
                $data['respondent'] = $respondent;
            }
                    
        } else {
            // No quota criteria set, so any respondent is eligible for an interview
            $respondent = Respondent::search($query)
                                            ->first();

            if ($respondent != null) {
                $data['respondent'] = $respondent;
            } elseif ($data['respondent'] == null) {
                
                return redirect()->back()->with('info', 'Search index is empty or respondents database is exhausted.');
            }
        } 

        $data['project'] = Project::find($project_id);

        $data['survey'] = Schema::find($request->input('survey_id'));
        $data['interview_id'] = $request->input('interview_id');

        //dd($data);

        return view('interviews.begin', $data);

    }

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
