<?php

namespace App\Http\Controllers;

use App\Exports\ResultsExport;
use App\Exports\ResultSheetExport;
use App\Exports\ResultsjsonExport;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Jobs\ExportSurveyResults;
use App\Jobs\MailSurveyResults;
use App\Mail\SurveyResultsExport;
use App\Models\Interview;
use App\Models\Project;
use App\Models\Respondent;
use App\Models\Result;
use App\Models\Schema;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use OzdemirBurak\JsonCsv\File\Json;
use SimpleXMLElement;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['results'] = Result::paginate();
        //dd($data);

        return view('results.index', $data);
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
    public function store(StoreResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['result'] = Result::where('schema_id', $id)->first();

        //dd($data);

        return view('results.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $Result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultRequest $request, Result $Result)
    {
        dd('Here');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $Result)
    {
        //
    }


    /**
     * xlsx Survey Results Export
     */
    public function xlsx_export(int $schemaId)
    {
        $survey = Schema::find($schemaId);
        $surveyName = $survey->survey_name;
        $userId = auth()->user()->id;

        $userEmail = auth()->user()->email ?? 'kenneth.kipchumba@tifaresearch.com';
        $fileName = 'TIFA-Spreadsheet-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.xlsx';

        //dd($filePath);

        ExportSurveyResults::withChain([
            new MailSurveyResults($userEmail, $fileName, $schemaId, $surveyName),
        ])->dispatch($userId, $schemaId, $fileName, $surveyName);

        return back()->with('info', 'Results Export Download Link Will Be Sent To your Email Later On');
    }

    /**
     * xlsx Sheets Survey Results Export
     */
    public function xlsx_sheets_export(int $schemaId)
    {
        $survey = Schema::find($schemaId);
        $surveyName = $survey->survey_name;
        $userId = auth()->user()->id;

        $results = Result::where('schema_id', $schemaId)->get();

        $fileName = 'TIFA-SpreadSheets-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.xlsx';

        //dd($filePath);

        return (new ResultSheetExport($results))->download($fileName);
    }

    /**
     * JSON Results Export
     */
    public function json_export(Request $request)
    {
        $project_id = $request->input('project_id');
        $schema_id = $request->input('schema_id');
        $name = 'Undefined';

        if ($request->has('project_id'))
        {
            $project = Project::find($project_id);
            $name = $project->name ?? 'Project Not Found';
            //dd('Project Id:' . $project_id);
        }
        elseif ($request->has('schema_id'))
        {
            $survey = Schema::find($schema_id);
            $name = $survey->survey_name ?? 'Survey Not Found';
            //dd('Schema Id:' . $schema_id . ' ' . ($name));
        }
        else
        {
            return back()->with('error', 'To Download Survey Results, It Has To Belong To Either a Project or a Survey');
        }

        $fileName = 'TIFA-JSON-' . str_replace(' ', '-', $name) . '-' . now()->format('Y-m-d-H-i') . '-Results.json';

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $results = Result::query()
            ->join('interviews', 'results.interview_id', '=', 'interviews.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->leftJoin('respondents', 'interviews.respondent_id', '=', 'respondents.id')
            ->select(
                'interviews.id as interview_id',
                DB::raw('CONCAT(users.first_name, " ", users.last_name) as interviewer_name'),
                'interviews.respondent_id',
                'interviews.respondent_name',
                'interviews.phone_called',
                'interviews.start_time',
                'interviews.end_time',
                'respondents.occupation',
                'respondents.region',
                'respondents.county',
                'respondents.sub_county',
                'respondents.constituency',
                'respondents.ward',
                'respondents.gender',
                'respondents.dob',
                'respondents.exact_age',
                'respondents.education_level',
                'respondents.marital_status',
                'respondents.religion',
                'respondents.income',
                'respondents.Lsm',
                'respondents.ethnic_group',
                'respondents.employment_status',
                'respondents.age_group',
                'results.content',
            )
            /**
             * There is no project_id column on the results table.
             */
            // ->when($project_id, function ($query, $project_id)
            // {
            //     return $query->where('results.project_id', $project_id);
            // })
            ->when($schema_id, function ($query) use ($schema_id)
            {
                return $query->where('results.schema_id', $schema_id);
            })
            ->where('interviews.interview_status', 'Interview Completed')
            ->where(function ($query)
            {
                $query->where('interviews.quality_control', '<>', 'Cancelled')
                      ->orWhereNull('interviews.quality_control');
            })
            ->get();

        //dd($results);
        //if (count($results) == 0)
        if($results->isEmpty())
        {
            return back()->with('warning', 'The Survey Is Pending Quality Control');
        }

        // Decode the JSON Content column
        $results->map(function ($result)
        {
            $result->content = json_decode($result->content, true);
            return $result;
        });

        $resultsJson = $results->toJson(JSON_PRETTY_PRINT);

        return response($resultsJson, 200, $headers);
    }

    /**
     * JSON Results Export
     */
    public function jsonExportAllData(int $schemaId)
    {
        $survey = Schema::find($schemaId);
        $surveyName = $survey->survey_name;

        $fileName = 'TIFA-JSON-All-Data-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.json';

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $results = Result::query()
            ->join('interviews', 'results.interview_id', '=', 'interviews.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->leftJoin('respondents', 'interviews.respondent_id', '=', 'respondents.id')
            ->select(
                'interviews.id as interview_id',
                DB::raw('CONCAT(users.first_name, " ", users.last_name) as interviewer_name'),
                'interviews.respondent_id',
                'interviews.respondent_name',
                'interviews.phone_called',
                'interviews.start_time',
                'interviews.end_time',
                'respondents.occupation',
                'respondents.region',
                'respondents.county',
                'respondents.sub_county',
                'respondents.constituency',
                'respondents.ward',
                'respondents.gender',
                'respondents.dob',
                'respondents.exact_age',
                'respondents.education_level',
                'respondents.marital_status',
                'respondents.religion',
                'respondents.income',
                'respondents.Lsm',
                'respondents.ethnic_group',
                'respondents.employment_status',
                'respondents.age_group',
                'results.content',
            )
            ->where('results.schema_id', $schemaId)
            ->where('interviews.interview_status', 'Interview Completed')
            // ->where(function ($query)
            // {
            //     $query->where('interviews.quality_control', '<>', 'Cancelled')
            //           ->orWhereNull('interviews.quality_control');
            // })
            ->get();

        //dd($results);
        if (count($results) == 0)
        {
            return back()->with('warning', 'The Survey Is Pending Quality Control');
        }
        // Decode the JSON Content column
        $results->map(function ($result)
        {
            $result->content = json_decode($result->content, true);
            return $result;
        });

        $resultsJson = $results->toJson(JSON_PRETTY_PRINT);

        return response($resultsJson, 200, $headers);
    }

    /**
     *  XML Export Solution
     */
    public function xml_export(int $schemaId)
    {
        try {
            $survey = Schema::find($schemaId);

            if ($survey)
            {
                $surveyName = $survey->survey_name;

                $fileName = 'TIFA-XML-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.xml';

                $headers = [
                    'Content-Type' => 'text/xml',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ];

                $results = Result::query()
                    ->join('interviews', 'results.interview_id', '=', 'interviews.id')
                    ->join('users', 'results.user_id', '=', 'users.id')
                    ->select('interviews.id as interview_id','results.content')
                    ->where('results.schema_id', $schemaId)
                    ->where('interviews.interview_status', 'Interview Completed')
                    ->where(function ($query)
                    {
                        $query->where('interviews.quality_control', '<>', 'Cancelled')
                      ->orWhereNull('interviews.quality_control');
                    })
                    ->get();
                
                // Flatten Nested JSON Structure
                $flattenedResults = [];
                foreach ($results as $result) {
                    $flatResult = ['interview_id' => $result->interview_id];
                    $content = json_decode($result->content, true);

                    $this->flattenArray('', $content, $flatResult);

                    $flattenedResults[] = $flatResult;
                }

                // CONVERT TO XML
                $xmlData = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><results></results>');

                foreach ($flattenedResults as $result)
                {
                    $interview = $xmlData->addChild('interview');
                    foreach ($result as $key => $value)
                    {
                        $interview->addChild($key, $value);
                    }
                }

                return response($xmlData->asXML(), 200, $headers);
            }
            else
            {
                return redirect()->back(404)->with('warning', 'Survey Not Found');
            }

        } catch (Exception $e) {
            Log::error('XML Export Error: ' . $e->getMessage() . ' ' . $e->getTrace());
            return back()->with('error', 'XML Export Error: ' . $e->getMessage() . ' ' . $e->getTrace());
        }
    }

    // Function to flatten nested array with null values
    private function flattenArray($prefix, $array, &$result)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->flattenArray($prefix . $key . '_', $value, $result);
            } else {
                $result[$prefix . $key] = $value;
            }
        }
    }

    // Function to flatten nested JSON with null values
    private function flattenJson($keyPrefix, $data, &$flatResult, $hasNull = false): void
    {
        if (is_array($data))
        {
           foreach ($data as $subKey => $subValue)
           {
               $newKey = empty($keyPrefix) ? $subKey : $keyPrefix . '_' . $subKey;
               $this->flattenJson($newKey, $subValue, $flatResult, $hasNull || is_null($subValue));
           }    
        }
        else
        {
           $flatResult[$keyPrefix] = $data;
           $flatResult['has_null'] = $hasNull || is_null($data);
        }
    }
}
