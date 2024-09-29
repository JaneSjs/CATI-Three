<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schema extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'survey_name',
        'content',
        'version',
        'stage',
        'iframe_url',

        'type',
        'database',

        'updated_by',
        'deleted_by',
    ];

    /**
     * Survey Schema belongs to many Users
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Survey Schema belongs to a Project
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * A survey has one Quota Criteria
     */
    public function quota(): HasOne
    {
        return $this->hasOne(Quota::class);
    }

    /**
     * Processed Respondents
     *
     * This Survey has many respondents.
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }

    /**
     * Survey Schema has many interviews
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    /**
     * Survey Schema has many results
     */
    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    protected $casts = [
        'content'  =>  'array',
    ];
}