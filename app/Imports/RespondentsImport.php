<?php

namespace App\Imports;

use App\Models\Respondent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class RespondentsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Log::info("Importing respondent: {$row['name']}");

        return new Respondent([
            'r_id'          => $row['r_id'],
            'project_id'    => $row['project_id'],
            'name'          => $row['name'],
            'phone_1'       => $row['phone_1'],
            'phone_2'       => $row['phone_2'],
            'phone_3'       => $row['phone_3'],
            'phone_4'       => $row['phone_4'],
            'national_id'   => $row['national_id'],
            'email'         => $row['email'],
            'occupation'    => $row['occupation'],
            'region'        => $row['region'],
            'county'        => $row['county'],
            'sub_county'    => $row['sub_county'],
            'district'      => $row['district'],
            'division'      => $row['division'],
            'location'      => $row['location'],
            'sub_location'  => $row['sub_location'],
            'constituency'  => $row['constituency'],
            'ward'          => $row['ward'],
            'sampling_point' => $row['sampling_point'],
            'setting'       => $row['setting'],
            'gender'        => $row['gender'],
            'dob'        => $row['dob'],
            'exact_age'     => $row['exact_age'],
            'education_level' => $row['education_level'],
            'marital_status' => $row['marital_status'],
            'religion'      => $row['religion'],
            'income'        => $row['income'],
            'Lsm'           => $row['Lsm'] ?? $row['lsm'],
            'ethnic_group'  => $row['ethnic_group'],
            'employment_status' => $row['employment_status'],
            'interview_status'     => null,
            'interview_date_time'     => null,
            'last_downloaded_date'     => null
        ]);
    }

    public function rules(): array
    {
        return [
            '*.phone_1' => ['unique:respondents,phone_1'],
        ];
    }

    public function onFailure(Failure ...$failures)
    {
           foreach ($failures as $failure)
           {
                Log::error("Failed to import row {$failure->row()}: {$failure->errors()[0]}");
                $error = "Failed to import row {$failure->row()}: {$failure->errors()[0]}";

                Session::push('respondents_import_errors', $error);
           }
    }
}
