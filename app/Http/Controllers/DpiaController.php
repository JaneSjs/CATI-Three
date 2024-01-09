<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDpiaRequest;
use App\Http\Requests\UpdateDpiaRequest;
use App\Models\Dpia;
use App\Models\Project;
use Illuminate\Http\Request;

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
        $fileNames = [];
        $project_id = $request->input('project_id');
        $dpia = Dpia::where('project_id', $project_id)->first();
        //dd($dpia);

        if ($dpia)
        {
            //dd('Update');

            $dpia_documents = $request->file('dpia_documents');
            if ($request->hasFile($dpia_documents)) 
            {
                dd($dpia_documents);
                $this->handleMediaUploads($dpia, $request);

                return back()->with('success', 'DPIA Documents for this Project have been Saved');
            }

            dd('Here');

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
            //dd('Create');
            Dpia::create([
                'project_id' => $request->input('project_id'),
                'schema_id' => $request->input('schema_id'),
                'user_id' => auth()->user()->id,
                'dpia_approval' => $request->input('dpia_approval'),
            ]);

            return back()->with('success', 'DPIA for this Project has been captured Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($project_id, $schema_id = null)
    {
        $data['project'] = Project::where('id', $project_id)->first();

        $data['project_dpia'] = Dpia::where('project_id', $project_id)->first();

        $data['schema_dpia'] = Dpia::where('schema_id', $schema_id)->first();

        //dd($data);

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
        dd('Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dpia $dpia)
    {
        //
    }

    /**
     * File Uploads using Spatie Media Library
     * @param Dpia $dpia
     * @param Request $request
     */
    private function handleMediaUploads(Dpia $dpia, Request $request)
    {
        $mediaCollectionName = 'dpia_documents';
        
        // Clear existing media files in the collection
        $dpia->clearMediaCollection($mediaCollectionName);

        // Add new media files to the collection
        foreach ($request->file('dpia_documents') as $document)
        {
            $dpia->addMedia($document)->toMediaCollection($mediaCollectionName);
        }
    }
}
