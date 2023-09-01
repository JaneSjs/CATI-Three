<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InterviewSchedule extends Model
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
        'interview_datetime',
        'interview_url'
    ];

    /**
     * An interview Schedule belongs to a User 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An interview Schedule belongs to a Project
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * An interview Schedule belongs to a Survey
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Schema::class, 'schema_id');
    }

    /**
     * An Interview Schedule may have one Survey result
     */
    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }
}
