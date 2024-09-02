<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchemaRequest;
use App\Http\Requests\UpdateSchemaRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Interview;
use App\Models\Schema;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class SchemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('admin') || auth()->user()->id == 1){
            $data['surveys'] = Schema::orderBy('id', 'DESC')->paginate(10);
        } else {
            $user = User::find(auth()->user()->id);

            $data['surveys'] = $user->schemas()->orderBy('id', 'DESC')->paginate(10);
        }       

        return view('surveys.index', $data);
    }

    /**
     * Store survey name into the database
     */
    public function store(StoreSchemaRequest $request): RedirectResponse
    {
        //dd($request);
        $survey = Schema::create([
            'stage' => 'Draft',
            'project_id'  => $request->input('project_id'),
            'survey_name' => $request->input('survey_name'),
            'type' => $request->input('type'),
            'database' => $request->input('database'),
        ]);
        

        if ($survey) {
            $survey->users()->attach(auth()->user()->id);
            //$survey->projects()->attach($request->input('project_id'));

           return redirect()->back()->with('success', 'Survey Has Been Created Successfully');
        } else {
            // Send Email Notification
           return redirect()->back()->with('warning', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Schema $survey)
    {
        $data['survey'] = $survey;
        $data['results'] = $survey->results;

        $data['pending_interviews'] = $survey->interviews()
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', NULL)
                                    ->orderBy('id', 'desc')
                                    ->paginate(100)->withQueryString();

        $data['total_pending_interviews'] = $survey->interviews()
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', NULL)
                                    ->count();

        // Find Possible Duplicate Interviews
        $duplicate_respondent_ids = $survey->interviews()
                                        ->select('respondent_id')
                                        ->where('interview_status', 'Interview Completed')
                                        ->where('quality_control', NULL)
                                        ->groupBy('respondent_id')
                                        ->havingRaw('COUNT(*) > 1')
                                        ->pluck('respondent_id');

        $data['duplicate_interviews'] = $survey->interviews()
                                    ->whereIn('respondent_id', $duplicate_respondent_ids)
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', NULL)
                                    ->orderBy('id', 'desc')
                                    ->paginate(100)->withQueryString();

        $data['total_duplicate_interviews'] = $survey->interviews()
                                    ->whereIn('respondent_id', $duplicate_respondent_ids)
                                    ->where('interview_status', 'Interview Completed')
                                    ->where('quality_control', NULL)
                                    ->count();

        //dd('All Interviews: ' . count($data['interviews']) . ' Duplicate Interviews: ' . count($data['duplicate_interviews']));

        return view('surveys.show', $data);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['survey'] = Schema::find($id);
        //dd($data);

        return view('surveys.edit', $data);
    }

    /**
     * Update the Survey Schemas in storage.
     */
    public function update(UpdateSchemaRequest $request, $schema_id)
    {
        $schema = Schema::find($schema_id);
        //dd($schema);

        if ($schema)
        {
            $schema->update([
                'survey_name' => $request->input('survey_name'),
                'iframe_url'  => $request->input('iframe_url'),
                'stage' => $request->input('stage'),
                'updated_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'type' => $request->input('type'),
                'database' => $request->input('database'),
            ]);

            return redirect()->back()->with('success', 'Survey Updated Successfully.');
        } else {
            return redirect()->back()->with('error', 'Survey not found.');
        }
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schema $survey)
    {
        //
    }

    /**
     * Search Interviews
     */
    public function searchInterviews(Request $request)
    {
        $survey_id = $request->input('survey_id');
        $query = $request->input('query');

        $survey = Schema::where('id', $survey_id)->first();
        $data['survey'] = $survey;
        //dd($survey);

        $data['results'] = $survey->results;

        $data['interviews'] = Interview::search($query)
                                    ->where('schema_id', $survey_id)
                                    ->where('interview_status', 'Interview Completed')->paginate(10);
                                    //->where('quality_control', null)
                                    //->orderBy('id', 'asc')
                                    //->paginate(10);

        //dd($data['interviews']);

        return view('surveys.show', $data);
        
    }

}
