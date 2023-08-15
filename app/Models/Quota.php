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
    protected $fillable = ['project_id','schema_id','total_target','total_achieved','male_target','male_achieved','female_target','female_achieved'
    ];

    /**
     * Quota belongs to a Project
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Quota belongs to a Schema
     */
    public function schema(): BelongsTo
    {
        return $this->belongsTo(Schema::class);
    }
}
