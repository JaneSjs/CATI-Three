<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveySchema extends Model
{
    use HasFactory;

    /**
     * Survey Schema belongs to a User
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Survey Schema belongs to a Project
     *
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Survey Schema has many survey results
     * 
     */
    public function survey_results(): HasMany
    {
        return $this->hasMany(SurveyResult::class);
    }
}
