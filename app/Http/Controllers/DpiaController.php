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
        $project_id = $request->input('project_id');
        $dpia = Dpia::where('project_id', $project_id)->first();
        //dd($dpia);
        $dpia_documents = $request->file('dpia_documents');
        dd($project_id);

        // Create a new Dpia record
        if (!$dpia && !is_null($project_id))
        {
            $dpia_record = Dpia::create([
                'project_id' => $request->input('project_id'),
                'schema_id' => $request->input('schema_id'),
                'user_id' => auth()->user()->id,
                'dpia_approval' => $request->input('dpia_approval'),
            ]);

            if ($dpia_record)
            {
                return back()->with('success', 'DPIA for this Project has been captured Successfully');
            }
            else
            {
                    return back()->with('warning', 'DPIA for this Project has not been captured Successfully');
            }  
            
        }

        // Update Dpia record if it exists
        if ($dpia)
        {
            //dd('Update');

            if ($request->hasFile('dpia_documents')) 
            {
                // Upload Dpia document files
                dd($dpia_documents);
                $this->handleMediaUploads($dpia, $dpia_documents);

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
    private function handleMediaUploads(Dpia $dpia, $dpia_documents)
    {
        $mediaCollectionName = 'dpia_documents';
        
        // Clear existing media files in the collection
        $dpia->clearMediaCollection($mediaCollectionName);

        // Add new media files to the collection
        foreach ($dpia_documents as $document)
        {
            $dpia->addMedia($document)->toMediaCollection($mediaCollectionName);
        }
    }
}
