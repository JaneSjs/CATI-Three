<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['project_id','schema_id','attribute','value','target_count',
    ];

    /**
     * Quota belongs to a Schema
     */
    public function schema(): BelongsTo
    {
        return $this->belongsTo(Schema::class);
    }

    /**
     * Get Quota Criteria for a specific Survey
     * @param int $schema_id
     */
    public static function survey_quota_criteria($schema_id): array
    {
        $quota_criteria = [];

        $quotas = self::where('schema_id', $schema_id)->get();

        foreach ($quotas as $quota) {
            $quota_criteria[$quota->attribute][$quota->value] = $quota->target_count;
        }

        return $quota_criteria;
    }
}
