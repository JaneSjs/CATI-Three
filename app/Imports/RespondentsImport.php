<?php

namespace App\Imports;

use App\Jobs\IndexRespondents;
use App\Models\Respondent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class RespondentsImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsOnError, WithValidation, SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    protected $successfulCount = 0;
    protected $failedCount = 0;
    protected $importedRespondents = [];

    /**
     * Disable Meilisearch Indexing before the import
     */
    public function __construct()
    {
        Respondent::disableSearchSyncing();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try {
            Log::info("Importing respondent: {$row['name']}");
            DB::beginTransaction();

            $respondent = new Respondent([
                'r_id'            => $row['r_id'],
                'project_id'      => $row['project_id'],
                'schema_id'       => $row['survey_id'],
                'name'            => $row['name'],
                'phone_1'         => $row['phone_1'],
                'phone_2'         => $row['phone_2'],
                'phone_3'         => $row['phone_3'],
                'phone_4'         => $row['phone_4'],
                'national_id'     => $row['national_id'],
                'email'           => $row['email'],
                'occupation'      => $row['occupation'],
                'region'          => $row['region'],
                'county'          => $row['county'],
                'sub_county'      => $row['sub_county'],
                'district'        => $row['district'],
                'division'        => $row['division'],
                'location'        => $row['location'],
                'sub_location'    => $row['sub_location'],
                'constituency'    => $row['constituency'],
                'ward'            => $row['ward'],
                'sampling_point'  => $row['sampling_point'],
                'setting'         => $row['setting'],
                'gender'          => $row['gender'],
                'dob'             => $row['dob'],
                'exact_age'       => $row['exact_age'],
                'education_level' => $row['education_level'],
                'marital_status'  => $row['marital_status'],
                'religion'        => $row['religion'],
                'income'          => $row['income'],
                'Lsm'             => $row['Lsm'] ?? $row['lsm'],
                'ethnic_group'    => $row['ethnic_group'],
                'age_group'       => $row['age_group'],
                'employment_status' => $row['employment_status'],
                'interview_status'     => null,
                'interview_date_time'     => null,
                'last_downloaded_date'     => null
            ]);

            $respondent->save();
            DB::commit();

            $this->importedRespondents[] = $respondent;
            $this->successfulCount++;
            return $respondent;

        } catch (\Exception $e) {
            DB::rollBack();

            $this->failedCount++;
            Log::error("Error importing respondent: " .  $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }

    public function rules(): array
    {
        return [
            '*.project_id' => ['required'],
            '*.name' => ['required'],
            '*.phone_1' => ['unique:respondents,phone_1'],
            '*.national_id' => ['nullable','unique:respondents,national_id'],
        ];
    }

    /**
     * @param \Maatwebsite\Excel\Validators\Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure)
        {
            Log::error("Failed to import row {$failure->row()}: {$failure->errors()[0]}");
            $error = "Failed to import row {$failure->row()}: {$failure->errors()[0]}";

            Session::push('respondents_import_errors', $error);
        }

        // Continue importing subsequent rows on failure 
        return true;
    }

    public function getSuccessfulCount(): int
    {
        return $this->successfulCount;
    }

    public function getFailedCount(): int
    {
        return $this->failedCount;
    }

    /**
     * Specify the chunk size used when reading the file.
     */
    public function chunkSize(): int
    {
        // Process 100 rows at a time
        return 100;
    }

    /**
     * Dispatch imported respondents indexing
     */
    protected function dispatchIndexJob()
    {
        IndexRespondents::dispatch($this->importedRespondents);
    }

    /**
     * Re-enable Meilisearch Indexing
     * and trigger respondents indexing
     *  after the import
     */
    public function __destruct()
    {
        Respondent::enableSearchSyncing();
        // Trigger indexing
        $this->dispatchIndexJob();
    }
}
