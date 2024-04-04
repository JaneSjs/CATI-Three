<?php

namespace App\Http\Controllers;

use App\Exports\ResultsExport;
use App\Exports\ResultsjsonExport;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Jobs\ExportSurveyResults;
use App\Jobs\MailSurveyResults;
use App\Mail\SurveyResultsExport;
use App\Models\Interview;
use App\Models\Respondent;
use App\Models\Result;
use App\Models\Schema;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use OzdemirBurak\JsonCsv\File\Json;

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
     * Primitive CSV Survey Results Export
     */
    public function hold_csv_export(int $schemaId)
    {
        try {
            // return Excel::download(new ResultsjsonExport($schemaId), 'only_survey_results.csv', ExcelExcel::CSV, [
            //     'Content-Type' => 'text/csv',
            // ]);
            $survey = Schema::find($schemaId);

            if ($survey)
            {
                $surveyName = $survey->survey_name;

                $fileName = 'CSV-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.csv';

                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ];

                $results = Result::query()
                    ->join('interviews', 'results.interview_id', '=', 'interviews.id')
                    ->join('users', 'results.user_id', '=', 'users.id')
                    ->select('interviews.id','results.content')
                    ->where('results.schema_id', $schemaId)
                    ->where('interviews.interview_status', 'Interview Completed')
                    ->where('interviews.quality_control', '<>', 'Cancelled')
                    ->get();

                $csvData = [];
                //dd($results);

                foreach ($results as $result)
                {
                    $csvData[] = [
                        "interview_id" => $result->id,
                        "content" => $result->content // Include JSON content as is
                    ];
                }

                //print_r($csvData);exit;

                // Convert the array to json format
                $jsonData = json_encode($csvData);

                //print_r($jsonData);exit;

                // Use Laravel Storage for temporary file
                $disk = Storage::disk('temporary'); // Use 'temporary' disk or default

                $tempFileName = 'csv_export_' . uniqid();

                $tempFile = $disk->put($tempFileName, json_encode($csvData)); // Store data directly

                //dd($tempFile);
                if ($tempFile) {
                    $path = Storage::path('temporary/' . $tempFileName);
                    //dd($path);
                }

                // Json library can now use the stored file path
                $json = new Json($path);
                //dd($json);

                $csvString = $json->convert();
                //dd($csvString);

                $json->setConversionKey('utf8_encoding', true);

                $json->convertAndDownload();

                $disk->delete($tempFile);
 
            }
            else
            {
                return redirect()->back(404)->with('warning', 'Survey Not Found');
            }
        } catch (Exception $e) {
            Log::error("CSV Export Error. General Error Exporting Data: ". $e->getMessage());

            return back()->with('error', 'Failed To Export Survey Results Data to a CSV file: ' . $e->getMessage());
        }
    }

    /**
     * CSV Survey Results Export
     */
    public function attempt_csv_export(int $schemaId)
    {
        try {
            $survey = Schema::find($schemaId);

            if ($survey)
            {
                $surveyName = $survey->survey_name;

                $fileName = 'CSV-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.csv';

                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ];

                $results = Result::query()
                    ->join('interviews', 'results.interview_id', '=', 'interviews.id')
                    ->join('users', 'results.user_id', '=', 'users.id')
                    ->select('interviews.id','results.content')
                    ->where('results.schema_id', $schemaId)
                    ->where('interviews.interview_status', 'Interview Completed')
                    ->where('interviews.quality_control', '<>', 'Cancelled')
                    ->get();

                $csvData = [];
                $questions = [];
                //dd($results);

                foreach ($results as $result)
                {
                    $content = json_decode($result->content, true);

                    $questions = array_merge($questions, array_keys($content));

                    $csvData[] = array_merge(['interview_id' => $result->id], $content);
                }

                $questions = array_unique($questions);

                $csvHeader = array_merge($questions);
                //dd($csvHeader);

                $tempFile = fopen('php://temp', 'wb');

                if (mb_detect_encoding($csvHeader) === 'UTF-8') {
                    fwrite($tempFile, chr(0xEF) . chr(0xBB) . chr(0xBF));
                }

                fputcsv($tempFile, $csvHeader);

                foreach ($csvData as $row) {
                    fputcsv($tempFile, $row);
                }

                rewind($tempFile);
                $csvString = stream_get_contents($tempFile);
                fclose($tempFile);

                // Download the generated csv file
                return response()->streamDownload(function () use ($csvString)
                {
                    echo $csvString;
                }, $fileName, $headers);
 
            }
            else
            {
                return redirect()->back(404)->with('warning', 'Survey Not Found');
            }
        } catch (Exception $e) {
            Log::error("CSV Export Error. General Error Exporting Data: ". $e->getMessage());

            return back()->with('error', 'Failed To Export Survey Results Data to a CSV file: ' . $e->getMessage());
        }
    }

    /**
     * Muhidin CSV Export Solution
     */
    public function csv_export(int $schemaId)
    {
        try {
            $survey = Schema::find($schemaId);

            if ($survey)
            {
                $surveyName = $survey->survey_name;

                $fileName = 'CSV-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.csv';

                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ];

                $results = Result::query()
                    ->join('interviews', 'results.interview_id', '=', 'interviews.id')
                    ->join('users', 'results.user_id', '=', 'users.id')
                    ->select('interviews.id','results.content')
                    ->where('results.schema_id', $schemaId)
                    ->where('interviews.interview_status', 'Interview Completed')
                    ->where('interviews.quality_control', '<>', 'Cancelled')
                    ->get();
                
                echo count($results) . ' Interviews';
                //var_dump($results);
                foreach ($results as $result)
                {
                    $result = json_decode($result->content);
                    echo "<pre>";
                    print_r($result->question1);
                    echo "</pre>";
                }
                exit;

                //$csv = Writer::createFromString();

                foreach ($results as $result)
                {
                    $data = $result->content;

                    $resultData = json_decode($json, true);

                    $header = [];

                    $data = [];

                    array_push($header, 'question_id');

                    foreach ($resultData as $key => $value) {
                        array_push($header, $key);

                        array_push($data, $value);
                    }
                }

                // Remove duplicates from header array
                $header = array_unique($header);

                $csv->insertOne($header);

                $csv->insertAll($data);

                //print_r($csvData);exit;

                // Convert the array to json format
                $jsonData = json_encode($csvData);

                //print_r($jsonData);exit;

                // Use Laravel Storage for temporary file
                $disk = Storage::disk('temporary'); // Use 'temporary' disk or default

                $tempFileName = 'csv_export_' . uniqid();

                $tempFile = $disk->put($tempFileName, json_encode($csvData)); // Store data directly

                //dd($tempFile);
                if ($tempFile) {
                    $path = Storage::path('temporary/' . $tempFileName);
                    //dd($path);
                }

                
 
            }
            else
            {
                return redirect()->back(404)->with('warning', 'Survey Not Found');
            }

        } catch (Exception $e) {
            
        }
    }

    /**
     * PDF Results Export
     */
    public function pdf_export(int $id)
    {
        return Excel::download(new ResultsExport($id), 'survey_results.pdf', ExcelExcel::DOMPDF);
    }

    /**
     * JSON Results Export
     */
    public function json_export(int $schemaId)
    {
        $survey = Schema::find($schemaId);
        $surveyName = $survey->survey_name;

        $fileName = 'TIFA-JSON-' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.json';

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $results = Result::query()
            ->join('interviews', 'results.interview_id', '=', 'interviews.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('interviews.id','results.content')
            ->where('results.schema_id', $schemaId)
            ->where('interviews.interview_status', 'Interview Completed')
            ->where('interviews.quality_control', '<>', 'Cancelled')
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

    public function getresults(Request $request)
    {
        $survey = Schema::find($request->survey);
        // $structure = $survey->structure;

        if ($survey->stage == 'test') {
            $results =  Result::where('survey_id', $request->survey)->whereBetween('created_at', [$request->from, $request->to])->latest()->take(20)->get();
        } else {
            $results =  Result::where('survey_id', $request->survey)->whereBetween('created_at', [$request->from, $request->to])->get();
        }


        // // $results =  new Json($results);

        $new_array = array();
        // all the rows
        foreach ($results as $result) {
            $smallarray = $result->json;

            $interview = Interview::find($result->interview);
            $respondent = Respondent::find($interview->respondent);
            // rsort($smallarray);
            // array_push
            $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $interview->created_at, 'UTC')
                ->setTimezone('Africa/Nairobi');
            $smallarray = array("Phone Number Called" => $interview->phone_called) + $smallarray;
            if ($interview->qcd_by !== NULL) {
                // dd($interview);

                if ($interview->status == "Approved") {
                    $smallarray = array("Approved" => "Yes") + $smallarray;
                } else {
                    $smallarray = array("Approved" => " ") + $smallarray;
                }
                $smallarray = array("Quality Checked" => "Yes") + $smallarray;
            } else {
                $smallarray = array("Quality Checked" => "No") + $smallarray;
                $smallarray = array("Approved" => " ") + $smallarray;
            }
            $smallarray = array("date_of_interview" =>  date_format($datetime, "D-d-M-Y H:i:s")) + $smallarray;
            $smallarray = array("respondent_id" => $interview->respondent) + $smallarray;
            $smallarray = array("respondent name" => $respondent->name) + $smallarray;
            $smallarray = array("Iterview Start time" => $interview->start_time) + $smallarray;
            $smallarray = array("Iterview End  time" => $interview->end_time) + $smallarray;
            $smallarray = array("county" => $respondent->county) + $smallarray;
            $smallarray = array("region" => $respondent->town) + $smallarray;
            $smallarray = array("original_id" => $respondent->res_d) + $smallarray;
            $smallarray = array("interviewer" => User::find($interview->agent)->name) + $smallarray;
            $smallarray = array("interview_id" => $result->interview) + $smallarray;


            
        }


        // array_unshift($new_array, $structure);
        $new_array =  json_encode($new_array);


        if ($request->submit == "csv") {

            $fileName = $survey->name . '.json';
            $handle = fopen($fileName, 'w+');
            fputs($handle, $new_array);
            fclose($handle);




            $json = new Json($fileName);
            $json->setConversionKey('utf8_encoding', true);
           



            // fpassthru($f);

            if ($results->first()) {
                $json->convertAndDownload();
                // return response()->attachment($result, $survey->name . time());
            } else {
                return redirect()->back()->with(['message' => "Results from the specified period could not be found", 'alert-type' => 'error']);
            }
        } else if ($request->submit == "json") {
            if ($results->first()) {
                $fileName = $survey->name . '_datafile.json';
                $handle = fopen($fileName, 'w+');
                fputs($handle, $new_array);
                fclose($handle);
                $headers = array('Content-type' => 'application/json');
                return response()->download($fileName, time() . '_datafile.json', $headers);
            } else {
                return redirect()->back()->with(['message' => "Results from the specified period could not be found", 'alert-type' => 'error']);
            }
        }
    }
}
