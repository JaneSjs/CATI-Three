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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use SplTempFileObject;

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
     * CSV Survey Results Export
     */
    public function csv_export(int $schemaId)
    {
        // return Excel::download(new ResultsjsonExport($schemaId), 'only_survey_results.csv', ExcelExcel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
        $survey = Schema::find($schemaId);

        if ($survey)
        {
            $surveyName = $survey->survey_name;

            $fileName = 'TIFA-CSV' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.csv';

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

            // Convert JSON results to CSV Format
            $csv = new SplTempFileObject();

            // Write Interview Id header
            $csv->fputcsv(['interview_id','content']);

            //Function to extract question keys and answer values recursively
            function processData($data, $csv)
            {
                foreach ($data as $key => $value)
                {
                    if (is_array($value))
                    {
                        processData($value, $csv); 
                    }
                    else
                    {
                        $csv->fputcsv([$key, $value]);
                    }
                }
            }

            foreach ($results as $result) {
                $decodedData = json_decode($result->content, true);

                $csv->fputcsv([$result->id]);
                processData($decodedData, $csv);
            }

            return response($csv, 200, $headers);    
        }
        else
        {
            return redirect()->back(404)->with('warning', 'Survey Not Found');
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

        $fileName = 'TIFA-JSON' . str_replace(' ', '-', $surveyName) . '-' . now()->format('Y-m-d-H-i') . '-Results.json';

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

        $resultsJson = json_encode($results, JSON_PRETTY_PRINT);

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
