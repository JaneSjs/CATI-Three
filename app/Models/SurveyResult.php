<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'survey_schema_id',
        'ip_address',
        'mac_address',
        'user_agent',
        'latitude',
        'longitude',
        'content'
    ];

    /**
     * Survey Results belongs to a Survey Schema
     *
     */
    public function survey_schema(): BelongsTo
    {
        return $this->belongsTo(SurveySchema::class);
    }
}
