<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'phone_called',
        'qcd',
        'approved',
        'start_time',
        'end_time',
        'feedback',
    ];

    /**
     * An interview belongs to a Project
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
