<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchemaRequest;
use App\Http\Requests\UpdateSchemaRequest;
use App\Http\Resources\SchemaResource;
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

        $data['interviews'] = $survey->interviews;

        //dd($data['interviews']);

        return view('surveys.show', $data);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schema $survey)
    {
        $data['survey'] = $survey;
        //dd($data);

        return view('surveys.edit', $data);
    }

    /**
     * Update the Survey Schemas in storage.
     */
    public function update(Request $request)
    {

        $survey = Schema::find($request->id);
        
        if ($survey) {
            $survey->user_id = auth()->user()->id;
            $survey->project_id = $request->input('project_id');
            $survey->stage = $request->input('stage');
            $survey->updated_by = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $survey->save();

            //dd($survey);

            return response()->json([
                'message' => 'Survey Schema Updated Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Survey Schema was not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schema $survey)
    {
        //
    }

}
