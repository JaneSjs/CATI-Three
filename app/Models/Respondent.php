<?php

namespace App\Models;

//use App\Models\Scopes\RespondentScope;
use Carbon\Carbon;
//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * This model is to be used where the client is the data controller
 * while the research company is only the data processor.
 * In the case where the the company controls the data, use the RDMS API.
 */
class Respondent extends Model
{
    use HasFactory, SoftDeletes, Searchable;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['r_id','project_id','schema_id','name','phone_1','phone_2','phone_3','phone_4','national_id','email','occupation','region','county','sub_county','district','division','location','sub_location','constituency','ward','sampling_point','setting','gender','dob','exact_age','education_level','marital_status','religion','income','Lsm','ethnic_group','employment_status','age_group','interview_status','feedback','interview_date_time'
    ];

    public function toSearchableArray(): array
    {
        return [
            //'id'   => (int) $this->id,
            //'r_id' => (int) $this->r_id,
            'project_id' => (int) $this->project_id,
            //'schema_id'  => (int) $this->schema_id,
            'name'                => $this->name,
            'email'               => $this->email,
            'occupation'          => $this->occupation,
            'region'              => $this->region,
            'county'              => $this->county,
            'sub_county'          => $this->sub_county,
            'constituency'        => $this->constituency,
            'ward'                => $this->ward,
            'setting'             => $this->setting,
            'gender'              => $this->gender,
            'exact_age'           => (int) $this->exact_age,
            'education_level'     => $this->education_level,
            'marital_status'      => $this->marital_status,
            'religion'            => $this->religion,
            'income'              => $this->income,
            'Lsm'                 => $this->Lsm,
            'ethnic_group'        => $this->ethnic_group,
            'employment_status'   => $this->employment_status,
            'age_group'           => $this->age_group,
            'interview_status'    => $this->interview_status,
            'interview_date_time' => $this->interview_date_time,
        ];
    }

    public function shouldBeSearchable(): bool
    {
        if ($this->interview_date_time === NULL)
        {
            return true;
        }

        // Respondent is currently being interviewed by someone else.
        if ($this->interview_status == 'Locked')
        {
            return false;
        }

        if ($this->interview_status != 'Locked')
        {
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            $lastInterviewDate = Carbon::parse($this->interview_date_time);

            return $lastInterviewDate->lte($sixMonthsAgo);
        }
    }

    /**
     * Respondent belongs to a project
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Respondent belongs to a schema
     */
    public function schema(): BelongsTo
    {
        return $this->belongsTo(Schema::class);
    }

    /**
     * Respondent belongs to an Interview
     *
     */
    public function interview(): BelongsTo
    {
        return $this->belongsTo(Interview::class);
    }

    /**
     * User Feedbacks
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
