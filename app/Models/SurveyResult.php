<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyResult extends Model
{
    use HasFactory;

    /**
     * Survey Results belongs to a Survey Schema
     *
     */
    public function survey_schema(): BelongsTo
    {
        return $this->belongsTo(SurveySchema::class);
    }
}
