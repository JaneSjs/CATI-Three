<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDpiaRequest;
use App\Http\Requests\UpdateDpiaRequest;
use App\Models\Dpia;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DpiaController extends Controller
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
    public function store(StoreDpiaRequest $request)
    {
        $project_id = $request->input('project_id');
        $dpia = Dpia::where('project_id', $project_id)->first();
        //dd($dpia);

        // Update Dpia record if it exists
        if ($dpia)
        {
            //dd('Update Dpia record');

            $dpia->update([
                'project_id' => $request->input('project_id'),
                'schema_id' => $request->input('schema_id'),
                'user_id' => auth()->user()->id,
                'dpia_approval' => $request->input('dpia_approval')
            ]);

            return back()->with('success', 'DPIA for this Project has been Updated');    
        }
        else
        {
            // Create a new Dpia record
            $new_dpia = Dpia::create([
                'project_id' => $request->input('project_id'),
                'schema_id' => $request->input('schema_id'),
                'user_id' => auth()->user()->id,
                'dpia_approval' => $request->input('dpia_approval'),
            ]);

            if ($new_dpia)
            {
                return back()->with('success', 'DPIA for this Project has been captured Successfully');
            }
            else
            {
                    return back()->with('warning', 'DPIA for this Project has not been captured Successfully');
            }    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($project_id, $schema_id = null)
    {
        $project = Project::where('id', $project_id)->first();
        $data['project'] = $project;

        $data['project_dpia'] = Dpia::where('project_id', $project_id)->first();

        $data['schema_dpia'] = Dpia::where('schema_id', $schema_id)->first();

        $data['dpia_documents'] = $project->getMedia($project->name . ' DPIA documents');

        //dd($data['dpia_documents']);

        return view('dpias.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dpia $dpia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDpiaRequest $request, Dpia $dpia)
    {
        $dpia_documents = $request->file('dpia_documents');
        $project_name = $request->input('project_name');
        //dd($dpia_documents);

        // Upload DPIA documents
        if ($request->hasFile('dpia_documents')) 
        {
            foreach ($dpia_documents as $document)
            {
                //dd($document->getMimeType());

                // Check for duplicates (This is not working. Fix it)
                $file_exists = Media::query()
                                    ->where('collection_name', 'like', $project_name . 'DPIA documents')
                                    ->where('name', $document->getClientOriginalName())
                                    ->where('size', $document->getSize())
                                    ->first();

                if ($file_exists) {
                    session()->flash('warning', 'Possible Duplicate DPIA Document Found: ' . $file_exists->name);
                } else {
                    try {
                        $file = $dpia->addMedia($document)->toMediaCollection($project_name . ' DPIA documents');
                        $file->update([
                            'name' => $document->getClientOriginalName()
                        ]);
                        session()->flash('success', 'DPIA Documents for this Project have been Saved');
                    } catch (Exception $e) {
                        Log::error('Error Uploading DPIA Documents for this Project: ' . $e->getMessage());

                        session()->flash('error', 'Error Uploading DPIA Documents for this Project: ' . $e->getMessage());
                    }
                }
            }

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dpia $dpia)
    {
        //
    }
}
