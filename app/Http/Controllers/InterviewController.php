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
    private function areQuotasMet($respondent, $quotaCriteria)
    {
        // Initialize an array to store counts for each attribute
        $counts = [];

        foreach ($quotaCriteria as $attribute => $criteria)
        {
            if (isset($respondent->$attribute) && isset($criteria[$respondent->{$attribute}]))
            {
                // Fetch the count of respondents with the same attribute value
                $countAttribute = Respondent::where($attribute, $respondent->{$attribute})->count();

                $counts[$attribute] = $countAttribute;
            }

            // Check each attribute's count against the quota criteria
            foreach ($quotaCriteria as $attribute => $criteria)
            {
                if (isset($counts[$attribute]) && $counts[$attribute] >= $criteria[$respondent->{$attribute}])
                {
                    // Quota has been met for this attribute
                    return true;
                }
            }
        }
        
        // Quota is not met
        return false;
    }


    /**
     * Search for a respondent
     */
    public function search_respondent(Request $request)
    {
        //$interview_period = 0;
        $data['respondent'] = null;

        

        if ($query = $request->get('query'))
        {
            $respondent = Respondent::search($query)
                                            ->first();

            if ($respondent != null) {
                /**
                 * Check the Quotas Met
                 */

                $quotaCriteria = [
                    'occupation' => [
                        'Doctor' => 10,
                        'Teacher' => 15,
                        'Engineer' => 5,
                        // Add more occupations and target counts here
                    ],
                    'age' => [
                        // Define age groups and target counts here
                    ],
                    'region' => [
                        // Define regions and target counts here
                        'EASTERN' => 100
                    ],
                    'gender' => [
                        // Define genders and target counts here
                    ],
                    'religion' => [
                        // Define religions and target counts here
                    ],
                    // Add more attributes as needed
                ];

                if ($this->areQuotasMet($respondent, $quotaCriteria)) {
                    session()->flash('warning', 'Quota Met');
                }
                
                if ($respondent->interview_date_time == null)
                {
                    $data['respondent'] = $respondent;
                }
                else
                {
                    if ($respondent->interview_status == 'Interview Completed')
                    {
                        $last_interview_date = Carbon::parse($respondent->interview_date_time);

                        $current_date = Carbon::now();

                        $difference_in_days = $current_date->diffInDays($last_interview_date);

                        if ($difference_in_days > 60) {
                            $data['respondent'] = $respondent;
                        } else {
                            session()->flash('info', 'Found Respondent(s) have Interview Fatigue. 😩');
                        }
                    }

                    if ($respondent->interview_status == 'Locked')
                    {
                        session()->flash('info', 'That Respondent is Locked to another Interview. 🤙🏿');
                    }

                    $data['respondent'] = $respondent;
                }
            } else {
                return redirect()->back()->with('info', 'Search index is empty or database is exhausted.');
            }
            
            

        }

        $data['project'] = Project::find($request->input('project_id'));

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
