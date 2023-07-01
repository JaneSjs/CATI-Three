<?php

namespace App\Models;

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
    use HasFactory, Searchable, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['r_id','project_id','name','phone_1','phone_2','phone_3','phone_4','national_id','email','occupation','region','county','sub_county','district','division','location','sub_location','constituency','ward','sampling_point','setting','gender','exact_age','education_level','marital_status','religion','income','Lsm','ethnic_group','employment_status','age_group','interview_date_time','interview_status'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * User Feedbacks
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
