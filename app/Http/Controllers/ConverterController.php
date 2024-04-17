<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConverterRequest;
use App\Http\Requests\UpdateConverterRequest;
use App\Models\Converter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use OzdemirBurak\JsonCsv\File\Json;

class ConverterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('converters.index');
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
    public function store(StoreConverterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Converter $converter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Converter $converter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConverterRequest $request, Converter $converter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Converter $converter)
    {
        //
    }

    /**
     * Convert JSON File To CSV File
     */
    public function jsonToCsv(Request $request)
    {
        if ($request->hasFile('jsonFile'))
        {
            $file = $request->file('jsonFile');

            $fileName = $file->getRealPath();

            $json = new Json($fileName);

            $json->convertAndDownload();
        }
    }
}
