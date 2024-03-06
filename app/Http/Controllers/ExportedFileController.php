<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExportedFileRequest;
use App\Http\Requests\UpdateExportedFileRequest;
use App\Models\ExportedFile;
use Illuminate\Support\Facades\Storage;

class ExportedFileController extends Controller
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
    public function store(StoreExportedFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExportedFile $exportedFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExportedFile $exportedFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExportedFileRequest $request, ExportedFile $exportedFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExportedFile $exportedFile)
    {
        //
    }

    /**
     * Display the Exported Files
     */
    public function exported_files($userId = null, $projectId = null, $schemaId = null)
    {
        $data['exported_files'] = ExportedFile::where('user_id', auth()->user()->id)->paginate(10);

        return view('exported_files.index', $data);
    }

    /**
     * Download the Selected Exported File
     */
    public function download_exported_files($userId = null, $projectId, $schemaId = null)
    {
        $fileName = ExportedFile::where('user_id', $userId)->first();
        $filePath = 'public/' . $fileName->file_name;

        //dd($filePath);

        if (Storage::exists($filePath))
        {
            return Storage::download($filePath);
        }
        else
        {
            dd(Storage::exists($filePath));
            return back()->with('error', 'File is missing');
        }
    }
}
