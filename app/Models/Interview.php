<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Interview extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'schema_id',
        'respondent_id',
        'respondent_name',
        'ext_no',
        'phone_called',
        'audio_recording',
        'qcd_by',
        'interview_status',
        'survey_url',
        'quality_control',
        'start_time',
        'end_time',
        'feedback',
    ];

    /**
     * An interview belongs to a User 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An interview belongs to a Respondent 
     */
    public function respondent(): BelongsTo
    {
        return $this->belongsTo(Respondent::class);
    }

    /**
     * An interview belongs to a Project
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * An interview belongs to a Survey
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Schema::class, 'schema_id');
    }

    /**
     * An Interview has one Survey result
     */
    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }
}
